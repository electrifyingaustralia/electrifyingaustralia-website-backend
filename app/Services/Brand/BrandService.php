<?php

namespace App\Services\Brand;

use App\Repositories\Brand\BrandRepositoryInterface;
use App\Services\Brand\BrandServiceInterface;

class BrandService implements BrandServiceInterface
{
    public function __construct(protected BrandRepositoryInterface $brandRepository) {}

    public function getBrands(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->brandRepository->get($columns, $perPage);
    }

    public function getAllBrands(): object
    {
        return $this->brandRepository->all();
    }

    public function getBrandsList(): object
    {
        return $this->brandRepository->list();
    }

    public function findBrand(int $id): object
    {
        return $this->brandRepository->find($id);
    }

    public function createBrand(array $data): object
    {
        return $this->brandRepository->create($data);
    }

    public function updateBrand(int $id, array $data): object
    {
        return $this->brandRepository->update($id, $data);
    }

    public function deleteBrand(int $id): bool
    {
        return $this->brandRepository->delete($id);
    }
}
