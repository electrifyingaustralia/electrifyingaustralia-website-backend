<?php

namespace App\Services\ProjectType;

interface ProjectTypeServiceInterface
{
    public function get(array $columns = ['*']);
    public function findProjectType(int $id): object;
    public function createProjectType(array $data): object;
    public function updateProjectType(int $id, array $data): object;
    public function deleteProjectType(int $id): bool;
}
