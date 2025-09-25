<?php

namespace App\Services\Project;

use App\Repositories\Project\ProjectRepositoryInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use App\Services\Project\ProjectServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ProjectService implements ProjectServiceInterface
{
    public function __construct(
        protected ProjectRepositoryInterface $projectRepository,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->projectRepository->get($columns, $perPage, $filters);
    }

    public function createProject(array $data, \Illuminate\Http\UploadedFile|null $media = null): object
    {
        if ($media) {

            $existingMedia = $this->mediaLibrary->query()->where('original_name', $media->getClientOriginalName())->first();

            if ($existingMedia) {
                $data['media_id'] = $existingMedia->id;
            } else {
                $uploaded = $this->mediaLibrary->upload($media);
                $data['media_id'] = $uploaded->id;
            }
        }

        $data['slug'] = Str::slug($data['title']);

        return $this->projectRepository->create($data);
    }

    public function findProject(int $id): object
    {
        return $this->projectRepository->find($id);
    }

    public function updateProject(int $id, array $data): object
    {
        if (isset($data['media_id'])) {
            if (empty($data['media_id']) || $data['media_id'] === 'null') {
                $data['media_id'] = null;
            } else {
                // Verify the selected media exists
                $existingMedia = $this->mediaLibrary->findMedia($data['media_id']);
                if (!$existingMedia) {
                    $data['media_id'] = null;
                }
            }
        }

        $data['slug'] = Str::slug($data['title']);

        return $this->projectRepository->update($id, $data);
    }

    public function deleteProject(int $id): bool
    {
        return $this->projectRepository->delete($id);
    }

    public function attachImageToProject(int $projectId, int $mediaId): void
    {
        $this->projectRepository->attachImage($projectId, $mediaId);
    }

    public function detachImageFromProject(int $projectId, int $mediaId): void
    {
        $this->projectRepository->detachImage($projectId, $mediaId);
    }

    public function syncProjectImages(int $projectId, array $mediaIds): void
    {
        $this->projectRepository->syncImages($projectId, $mediaIds);
    }

    public function getProjectImages(int $projectId)
    {
        return $this->projectRepository->getImages($projectId);
    }
}
