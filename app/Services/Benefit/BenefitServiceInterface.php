<?php

namespace App\Services\Benefit;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

interface BenefitServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator;
    public function createBenefit(array $data, ?UploadedFile $media = null): object;
    public function findBenefit(int $id): object;
    public function updateBenefit(int $id, array $data): object;
    public function deleteBenefit(int $id): bool;
}
