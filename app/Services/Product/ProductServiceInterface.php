<?php

namespace App\Services\Product;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator;
    public function createProduct(array $data, ?UploadedFile $media = null): object;
    public function findProduct(int $id): object;
    public function updateProduct(int $id, array $data): object;
    public function deleteProduct(int $id): bool;
    public function attachImageToProduct(int $productId, int $mediaId): void;
    public function detachImageFromProduct(int $productId, int $mediaId): void;
    public function syncProductImages(int $productId, array $mediaIds): void;
    public function getProductImages(int $productId);
}
