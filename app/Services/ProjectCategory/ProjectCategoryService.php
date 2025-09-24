<?php

namespace App\Services\ProjectCategory;

use App\Repositories\ProjectCategory\ProjectCategoryRepositoryInterface;
use App\Services\ProjectCategory\ProjectCategoryServiceInterface;
use Illuminate\Support\Str;

class ProjectCategoryService implements ProjectCategoryServiceInterface
{
    public function __construct(protected ProjectCategoryRepositoryInterface $projectCategoryRepository) {}

    public function get(array $columns = ['*'])
    {
        return $this->projectCategoryRepository->get();
    }

    public function findProjectCategory(int $id): object
    {
        return $this->projectCategoryRepository->find($id);
    }

    public function createProjectCategory(array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->projectCategoryRepository->create($data);
    }

    public function updateProjectCategory(int $id, array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->projectCategoryRepository->update($id, $data);
    }

    public function deleteProjectCategory(int $id): bool
    {
        return $this->projectCategoryRepository->delete($id);
    }
}
