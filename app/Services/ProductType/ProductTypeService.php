<?php

namespace App\Services\ProductType;

use App\Repositories\ProductType\ProductTypeRepositoryInterface;
use App\Services\ProductType\ProductTypeServiceInterface;
use Illuminate\Support\Str;

class ProductTypeService implements ProductTypeServiceInterface
{
    public function __construct(protected ProductTypeRepositoryInterface $productTypeRepository) {}

    public function get(array $columns = ['*'])
    {
        return $this->productTypeRepository->get();
    }

    public function findProductType(int $id): object
    {
        return $this->productTypeRepository->find($id);
    }

    public function createProductType(array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->productTypeRepository->create($data);
    }

    public function updateProductType(int $id, array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->productTypeRepository->update($id, $data);
    }

    public function deleteProductType(int $id): bool
    {
        return $this->productTypeRepository->delete($id);
    }
}
