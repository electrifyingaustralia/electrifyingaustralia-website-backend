<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;


class ProductService implements ProductServiceInterface
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->productRepository->get($columns, $perPage, $filters);
    }

    public function createProduct(array $data, ?UploadedFile $media = null): object
    {
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

        return $this->productRepository->create($data);
    }

    public function findProduct(int $id): object
    {
        return $this->productRepository->find($id);
    }

    public function updateProduct(int $id, array $data): object
    {
        // $blog = $this->blogRepository->find($id);

        // Handle media_id from form data
        if (isset($data['media_id'])) {
            if (empty($data['media_id']) || $data['media_id'] === 'null') {
                $data['media_id'] = null;
            } else {
                // Verify the selected media exists
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

        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->delete($id);
    }
}
