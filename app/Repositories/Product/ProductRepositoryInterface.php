<?php

namespace App\Repositories\Product;

use Illuminate\Database\Eloquent\Builder;

interface ProductRepositoryInterface
{
    public function query(): Builder;
    public function get(array $columns = ["*"], int $perPage = 15, array $filters = []): object;
    public function all(): object;
    public function list(): object;
    public function find(int $id): object;
    public function view(int $id): object;
    public function create(array $data): object;
    public function update(int $id, array $data): object;
    public function exists(int $id): bool;
    public function delete(int $id): bool;
    public function attachImage(int $productId, int $mediaId): void;
    public function detachImage(int $productId, int $mediaId): void;
    public function syncImages(int $productId, array $mediaIds): void;
    public function getImages(int $productId);
}
