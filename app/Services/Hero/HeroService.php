<?php

namespace App\Services\Hero;

use App\Repositories\Hero\HeroRepositoryInterface;
use App\Services\Hero\HeroServiceInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class HeroService implements HeroServiceInterface
{
    public function __construct(
        protected HeroRepositoryInterface $heroRepository,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->heroRepository->get($columns, $perPage, $filters);
    }

    public function getHeroList(): object
    {
        return $this->heroRepository->list();
    }

    public function findHero(int $id): object
    {
        return $this->heroRepository->find($id);
    }

    public function createHero(array $data, ?UploadedFile $media = null): object
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

        return $this->heroRepository->create($data);
    }

    public function updateHero(int $id, array $data): object
    {

        if (isset($data['media_id'])) {
            if (empty($data['media_id']) || $data['media_id'] === 'null') {
                $data['media_id'] = null;
            } else {
                $existingMedia = $this->mediaLibrary->findMedia($data['media_id']);
                if (!$existingMedia) {
                    $data['media_id'] = null;
                }
            }
        }

        if (isset($data['is_active'])) {
            $data['is_active'] = (bool)$data['is_active'];
        }

        $data['slug'] = Str::slug($data['title']);

        return $this->heroRepository->update($id, $data);
    }

    public function deleteHero(int $id): bool
    {
        return $this->heroRepository->delete($id);
    }
}
