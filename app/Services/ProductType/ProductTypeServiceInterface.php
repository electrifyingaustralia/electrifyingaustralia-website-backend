<?php

namespace App\Services\ProductType;

interface ProductTypeServiceInterface
{
    public function get(array $columns = ['*']);
    public function findProductType(int $id): object;
    public function createProductType(array $data): object;
    public function updateProductType(int $id, array $data): object;
    public function deleteProductType(int $id): bool;
}
