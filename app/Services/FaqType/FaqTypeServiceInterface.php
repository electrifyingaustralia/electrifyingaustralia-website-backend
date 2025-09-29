<?php

namespace App\Services\FaqType;

interface FaqTypeServiceInterface
{
    public function get(array $columns = ['*']);
    public function findFaqType(int $id): object;
    public function createFaqType(array $data): object;
    public function updateFaqType(int $id, array $data): object;
    public function deleteFaqType(int $id): bool;
}
