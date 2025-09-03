<?php

namespace App\Services\Team;

use App\Repositories\Team\TeamRepositoryInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use App\Services\Team\TeamServiceInterface;
use Illuminate\Http\UploadedFile;

class TeamService implements TeamServiceInterface
{
    public function __construct(
        protected TeamRepositoryInterface $teamRepository,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function getTeamMembers(array $columns = ["*"], int $perPage = 15): object
    {
        return $this->teamRepository->get($columns, $perPage);
    }

    public function getAllTeamMembers(): object
    {
        return $this->teamRepository->all();
    }

    public function getTeamMembersList(): object
    {
        return $this->teamRepository->list();
    }

    public function findTeamMember(int $id): object
    {
        return $this->teamRepository->find($id);
    }

    public function createTeamMember(array $data, ?UploadedFile $media = null): object
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

        return $this->teamRepository->create($data);
    }

    public function updateTeamMember(int $id, array $data): object
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
        return $this->teamRepository->update($id, $data);
    }

    public function deleteTeamMember(int $id): bool
    {
        return $this->teamRepository->delete($id);
    }
}
