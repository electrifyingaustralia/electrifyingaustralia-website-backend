<?php

namespace App\Services\ProjectType;

use App\Repositories\ProjectType\ProjectTypeRepositoryInterface;
use App\Services\ProjectType\ProjectTypeServiceInterface;
use Illuminate\Support\Str;

class ProjectTypeService implements ProjectTypeServiceInterface
{
    public function __construct(protected ProjectTypeRepositoryInterface $projectTypeRepository) {}

    public function get(array $columns = ['*'])
    {
        return $this->projectTypeRepository->get();
    }

    public function findProjectType(int $id): object
    {
        return $this->projectTypeRepository->find($id);
    }

    public function createProjectType(array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->projectTypeRepository->create($data);
    }

    public function updateProjectType(int $id, array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->projectTypeRepository->update($id, $data);
    }

    public function deleteProjectType(int $id): bool
    {
        return $this->projectTypeRepository->delete($id);
    }
}
