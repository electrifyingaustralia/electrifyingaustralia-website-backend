<?php

namespace App\Services\Brand;

interface BrandServiceInterface
{
    public function getBrands(array $columns = ["*"], int $perPage = 15): object;
    public function getAllBrands(): object;
    public function getBrandsList(): object;
    public function findBrand(int $id): object;
    public function createBrand(array $data): object;
    public function updateBrand(int $id, array $data): object;
    public function deleteBrand(int $id): bool;
}
