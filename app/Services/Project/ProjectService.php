<?php

namespace App\Services\Project;

use App\Repositories\Project\ProjectRepositoryInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use App\Services\Project\ProjectServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

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

        return $this->projectRepository->update($id, $data);
    }

    public function deleteProject(int $id): bool
    {
        return $this->projectRepository->delete($id);
    }
}
