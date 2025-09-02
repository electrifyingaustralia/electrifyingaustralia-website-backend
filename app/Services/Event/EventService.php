<?php

namespace App\Services\Event;

use App\Repositories\Event\EventRepositoryInterface;
use App\Services\Event\EventServiceInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;


class EventService implements EventServiceInterface
{
    public function __construct(
        protected EventRepositoryInterface $eventRepository,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->eventRepository->get($columns, $perPage, $filters);
    }

    public function createEvent(array $data, ?UploadedFile $media = null): object
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

        return $this->eventRepository->create($data);
    }

    public function findEvent(int $id): object
    {
        return $this->eventRepository->find($id);
    }

    public function updateEvent(int $id, array $data): object
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

        if (isset($data['is_active'])) {
            $data['is_active'] = (bool)$data['is_active'];
        }

        return $this->eventRepository->update($id, $data);
    }

    public function deleteEvent(int $id): bool
    {
        return $this->eventRepository->delete($id);
    }
}
