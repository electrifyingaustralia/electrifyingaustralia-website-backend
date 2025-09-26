<?php

namespace App\Services\Project;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator;
    public function createProject(array $data, ?UploadedFile $media = null): object;
    public function findProject(int $id): object;
    public function updateProject(int $id, array $data): object;
    public function deleteProject(int $id): bool;
    public function attachImageToProject(int $projectId, int $mediaId): void;
    public function detachImageFromProject(int $projectId, int $mediaId): void;
    public function syncProjectImages(int $projectId, array $mediaIds): void;
    public function getProjectImages(int $projectId);
}
