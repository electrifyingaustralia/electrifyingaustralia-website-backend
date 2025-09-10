<?php

namespace App\Services\Quotation;

use App\Repositories\Quotation\QuotationRepositoryInterface;
use App\Services\Quotation\QuotationServiceInterface;

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
}
