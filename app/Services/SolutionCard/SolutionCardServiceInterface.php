<?php

namespace App\Services\SolutionCard;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

interface SolutionCardServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15): object;

    public function createSolutionCard(array $data): object;

    public function findSolutionCard(int $id): object;

    public function updateSolutionCard(int $id, array $data): object;

    public function deleteSolutionCard(int $id): bool;
}
