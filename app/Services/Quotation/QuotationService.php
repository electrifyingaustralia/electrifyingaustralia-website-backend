<?php

namespace App\Services\Quotation;

use App\Repositories\Quotation\QuotationRepositoryInterface;
use App\Services\Quotation\QuotationServiceInterface;
use Illuminate\Support\Facades\DB;

class QuotationService implements QuotationServiceInterface
{
    public function __construct(protected QuotationRepositoryInterface $quotationRepository) {}

    public function get(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->quotationRepository->get($columns, $perPage);
    }

    public function createQuotation(array $data): object
    {
        return $this->quotationRepository->create($data);
    }

    public function findQuotation(int $id): object
    {
        return $this->quotationRepository->find($id);
    }

    public function updateQuotation(int $id, array $data): object
    {
        return $this->quotationRepository->update($id, $data);
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
