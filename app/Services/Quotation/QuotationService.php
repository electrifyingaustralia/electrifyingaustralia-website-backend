<?php

namespace App\Services\Quotation;

use App\Repositories\Quotation\QuotationRepositoryInterface;
use App\Services\Quotation\QuotationServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuotationService implements QuotationServiceInterface
{
    public function __construct(protected QuotationRepositoryInterface $quotationRepository) {}

    public function get(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->quotationRepository->query()
            ->select($columns)
            ->latest('id')
            ->paginate($perPage);
    }

    public function createQuotation(array $data): object
    {
        $slug = Str::slug($data['category']);

        $payload = [
            "slug" => $slug,
            "category" => $data["category"],
        ];

        $parent = $this->quotationRepository->create($payload);

        $categories = array_filter((array) ($data["subcategory"] ?? []), function ($category) {
            return !empty(trim($category));
        });

        foreach ($categories as $category) {
            $trimmedCategory = trim($category);
            if (!empty($trimmedCategory)) {
                $slug = Str::slug($trimmedCategory);

                $payload = [
                    "parent_id" => $parent->id,
                    "slug" => $slug,
                    "category" => $trimmedCategory,
                ];

                $this->quotationRepository->create($payload);
            }
        }

        return $parent;
    }

    public function findQuotation(int $id): object
    {
        return $this->quotationRepository->find($id);
    }

    public function updateQuotation(int $id, array $data): object
    {
        $data['slug'] = Str::slug($data['category']);

        $slug = Str::slug($data['category']);

        $payload = [
            "slug" => $slug,
            "category" => $data["category"],
        ];

        $parent = $this->quotationRepository->update($id, $payload);

        // Filter out empty sub-categories
        $categories = array_filter((array) ($data["subcategory"] ?? []), function ($category) {
            return !empty(trim($category));
        });

        foreach ($categories as $category) {
            $trimmedCategory = trim($category);
            if (!empty($trimmedCategory)) {
                $slug = Str::slug($trimmedCategory);

                $payload = [
                    "parent_id" => $id,
                    "slug" => $slug,
                    "category" => $trimmedCategory,
                ];

                $this->quotationRepository->create($payload);
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
