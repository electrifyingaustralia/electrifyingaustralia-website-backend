<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductService implements ProductServiceInterface
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected MediaLibraryServiceInterface $mediaLibrary,
        protected ProductAttributeRepositoryInterface $productAttributeRepository
    ) {}

    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->productRepository->get($columns, $perPage, $filters);
    }

    public function createProduct(array $data, ?UploadedFile $media = null): object
    {
        DB::beginTransaction();

        try {
            if ($media) {
                $existingMedia = $this->mediaLibrary->query()->where('original_name', $media->getClientOriginalName())->first();

                if ($existingMedia) {
                    $data['media_id'] = $existingMedia->id;
                } else {
                    $uploaded = $this->mediaLibrary->upload($media);
                    $data['media_id'] = $uploaded->id;
                }
            }

            $data['slug'] = Str::slug($data['name']);

            // Extract attributes from data before creating product
            $attributes = $data['attributes'] ?? [];
            unset($data['attributes']); // Remove attributes from product data

            // Create the product
            $product = $this->productRepository->create($data);

            // Create attributes if they exist
            if (!empty($attributes)) {
                $this->createProductAttributes($product->id, $attributes);
            }

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function findProduct(int $id): object
    {
        return $this->productRepository->find($id);
    }

    public function updateProduct(int $id, array $data): object
    {
        DB::beginTransaction();

        try {
            // Handle media_id from form data
            if (isset($data['media_id'])) {
                if (empty($data['media_id']) || $data['media_id'] === 'null') {
                    $data['media_id'] = null;
                } else {
                    $existingMedia = $this->mediaLibrary->findMedia($data['media_id']);
                    if (!$existingMedia) {
                        $data['media_id'] = null;
                    }
                }
            }

            // Ensure boolean values
            if (isset($data['is_active'])) {
                $data['is_active'] = (bool)$data['is_active'];
            }

            $data['slug'] = Str::slug($data['name']);

            // Extract attributes from data before updating product
            $attributes = $data['attributes'] ?? [];
            unset($data['attributes']); // Remove attributes from product data

            // Update the product
            $product = $this->productRepository->update($id, $data);

            // Update attributes if they exist
            if (isset($attributes)) {
                $this->updateProductAttributes($product->id, $attributes);
            }

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->delete($id);
    }

    private function createProductAttributes(int $productId, array $attributes): void
    {
        foreach ($attributes as $attribute) {
            if (!empty($attribute['key'])) {
                $this->productAttributeRepository->create([
                    'product_id' => $productId,
                    'attrs_key' => $attribute['key'],
                    'attrs_value' => $attribute['value'] ?? null,
                    'media_id' => $attribute['media_id'] ?? null,
                ]);
            }
        }
    }

    private function updateProductAttributes(int $productId, array $attributes): void
    {
        // First, get existing attributes to preserve their media IDs
        $existingAttributes = $this->productAttributeRepository->getByProductId($productId);

        // Create a map of existing attributes by key for quick lookup
        $existingAttributesMap = [];
        foreach ($existingAttributes as $existingAttr) {
            $existingAttributesMap[$existingAttr->attrs_key] = $existingAttr;
        }

        // Delete all existing attributes for this product
        $this->productAttributeRepository->deleteByProductId($productId);

        // Then create new ones, preserving media IDs where possible
        foreach ($attributes as $attribute) {
            if (!empty($attribute['key'])) {
                $mediaId = $attribute['media_id'] ?? null;

                // If no media_id provided in the update, check if we had one previously
                if (empty($mediaId) && isset($existingAttributesMap[$attribute['key']])) {
                    $mediaId = $existingAttributesMap[$attribute['key']]->media_id;
                }

                $this->productAttributeRepository->create([
                    'product_id' => $productId,
                    'attrs_key' => $attribute['key'],
                    'attrs_value' => $attribute['value'] ?? null,
                    'media_id' => $mediaId, // Use preserved or new media_id
                ]);
            }
        }
    }

    public function findProductWithAttributes(int $id): object
    {
        $product = $this->productRepository->find($id);
        $product->attributes = $this->productAttributeRepository->getByProductIdWithMedia($id);

        return $product;
    }
}
