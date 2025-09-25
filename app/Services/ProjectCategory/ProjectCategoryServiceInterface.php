<?php

namespace App\Services\ProjectCategory;

interface ProjectCategoryServiceInterface
{
    public function get(array $columns = ['*']);
    public function findProjectCategory(int $id): object;
    public function createProjectCategory(array $data): object;
    public function updateProjectCategory(int $id, array $data): object;
    public function deleteProjectCategory(int $id): bool;
}
