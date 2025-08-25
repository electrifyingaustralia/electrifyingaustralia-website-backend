<?php

namespace App\Services\Brand;

use App\Models\Brand;
use Illuminate\Http\UploadedFile;

interface BrandServiceInterface
{
    public function paginateListBrands(array $columns = ['*'], int $perPage = 15, array $filters = []);
    public function createBrand(array $data, ?UploadedFile $logo = null): object;
    public function findBrand(int $id): object;
    public function updateBrand(int $id, array $data, ?UploadedFile $logo = null): object;
    public function deleteBrand(int $id): bool;
}
