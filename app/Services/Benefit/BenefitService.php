<?php

namespace App\Services\Benefit;

use App\Repositories\Benefit\BenefitRepositoryInterface;
use App\Services\Benefit\BenefitServiceInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class BenefitService implements BenefitServiceInterface
{
    public function __construct(
        protected BenefitRepositoryInterface $benefitRepository,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->benefitRepository->get($columns, $perPage, $filters);
    }

    public function createBenefit(array $data, ?UploadedFile $media = null): object
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

        return $this->benefitRepository->create($data);
    }

    public function findBenefit(int $id): object
    {
        return $this->benefitRepository->find($id);
    }

    public function updateBenefit(int $id, array $data): object
    {
        // $blog = $this->blogRepository->find($id);

        // Handle media_id from form data
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

        return $this->benefitRepository->update($id, $data);
    }

    public function deleteBenefit(int $id): bool
    {
        return $this->benefitRepository->delete($id);
    }
}
