<?php

namespace App\Services\Quotation;

use Illuminate\Http\UploadedFile;

interface QuotationServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15): object;
    public function createQuotation(array $data, ?UploadedFile $media = null): object;
    public function findQuotation(int $id): object;
    public function updateQuotation(int $id, array $data, ?UploadedFile $media = null): object;
    public function deleteQuotation(int $id): bool;
    public function getAvailableQuestions($sectionId);
    public function removeQuestion($sectionId, $questionId);
    public function assignMultipleQuestions($sectionId, array $questionIds);
    public function updateQuestionOrder($sectionId, $questionIds);
}
