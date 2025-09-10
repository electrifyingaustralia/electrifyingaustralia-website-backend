<?php

namespace App\Services\Quotation;

interface QuotationServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15): object;
    public function createQuotation(array $data): object;
    public function findQuotation(int $id): object;
    public function updateQuotation(int $id, array $data): object;
    public function deleteQuotation(int $id): bool;
}
