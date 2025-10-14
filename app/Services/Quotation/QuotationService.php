<?php

namespace App\Services\Quotation;

use App\Repositories\Quotation\QuotationRepositoryInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use App\Services\Quotation\QuotationServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuotationService implements QuotationServiceInterface
{
    public function __construct(
        protected QuotationRepositoryInterface $quotationRepository,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function get(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->quotationRepository->query()
            ->select($columns)
            ->latest('id')
            ->paginate($perPage);
    }

    public function createQuotation(array $data, ?UploadedFile $media = null): object
    {
        $slug = Str::slug($data['category']);

        $payload = [
            "slug" => $slug,
            "category" => $data["category"],
        ];

        // Handle media upload if file is provided
        if ($media) {
            $existingMedia = $this->mediaLibrary->query()->where('original_name', $media->getClientOriginalName())->first();

            if ($existingMedia) {
                $payload['media_id'] = $existingMedia->id;
            } else {
                $uploaded = $this->mediaLibrary->upload($media);
                $payload['media_id'] = $uploaded->id;
            }
        }
        // Handle media_id from form if provided (from media library selection)
        elseif (isset($data['media_id']) && !empty($data['media_id'])) {
            $existingMedia = $this->mediaLibrary->findMedia($data['media_id']);
            if ($existingMedia) {
                $payload['media_id'] = $existingMedia->id;
            }
        }

        $parent = $this->quotationRepository->create($payload);

        $categories = array_filter((array) ($data["subcategory"] ?? []), function ($category) {
            return !empty(trim($category));
        });

        foreach ($categories as $category) {
            $trimmedCategory = trim($category);
            if (!empty($trimmedCategory)) {
                $slug = Str::slug($trimmedCategory);

                $subPayload = [
                    "parent_id" => $parent->id,
                    "slug" => $slug,
                    "category" => $trimmedCategory,
                ];

                $this->quotationRepository->create($subPayload);
            }
        }

        return $parent;
    }

    public function findQuotation(int $id): object
    {
        return $this->quotationRepository->find($id);
    }

    public function updateQuotation(int $id, array $data, ?UploadedFile $media = null): object
    {
        $slug = Str::slug($data['category']);

        $payload = [
            "slug" => $slug,
            "category" => $data["category"],
        ];

        // Handle media upload if file is provided
        if ($media) {
            $existingMedia = $this->mediaLibrary->query()->where('original_name', $media->getClientOriginalName())->first();

            if ($existingMedia) {
                $payload['media_id'] = $existingMedia->id;
            } else {
                $uploaded = $this->mediaLibrary->upload($media);
                $payload['media_id'] = $uploaded->id;
            }
        }
        // Handle media_id from form if provided (from media library selection)
        elseif (isset($data['media_id'])) {
            if (empty($data['media_id']) || $data['media_id'] === 'null') {
                $payload['media_id'] = null;
            } else {
                $existingMedia = $this->mediaLibrary->findMedia($data['media_id']);
                if ($existingMedia) {
                    $payload['media_id'] = $existingMedia->id;
                } else {
                    $payload['media_id'] = null;
                }
            }
        }

        $parent = $this->quotationRepository->update($id, $payload);

        // Filter out empty sub-categories
        $categories = array_filter((array) ($data["subcategory"] ?? []), function ($category) {
            return !empty(trim($category));
        });

        foreach ($categories as $category) {
            $trimmedCategory = trim($category);
            if (!empty($trimmedCategory)) {
                $slug = Str::slug($trimmedCategory);

                $subPayload = [
                    "parent_id" => $id,
                    "slug" => $slug,
                    "category" => $trimmedCategory,
                ];

                $this->quotationRepository->create($subPayload);
            }
        }

        return $parent;
    }

    public function deleteQuotation(int $id): bool
    {
        return $this->quotationRepository->delete($id);
    }

    public function assignQuestionsToSection($sectionId, array $questionIds): void
    {
        DB::transaction(function () use ($sectionId, $questionIds) {
            $this->quotationRepository->attachQuestions($sectionId, $questionIds);
        });
    }

    public function getAvailableQuestions($sectionId)
    {
        return $this->quotationRepository->getAvailableQuestions($sectionId);
    }

    public function removeQuestion($sectionId, $questionId): void
    {
        DB::transaction(function () use ($sectionId, $questionId) {
            $this->quotationRepository->detachQuestion($sectionId, $questionId);
        });
    }

    public function assignMultipleQuestions($sectionId, array $questionIds): void
    {
        DB::transaction(function () use ($sectionId, $questionIds) {
            $this->quotationRepository->attachQuestions($sectionId, $questionIds);
        });
    }

    public function updateQuestionOrder($sectionId, $questionIds)
    {
        return DB::transaction(function () use ($sectionId, $questionIds) {
            return $this->quotationRepository->updateQuestionOrder($sectionId, $questionIds);
        });
    }
}
