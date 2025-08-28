<?php

namespace App\Services\Faq;

interface FaqServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15): object;

    public function createFaq(array $data): object;

    public function findFaq(int $id): object;

    public function updateFaq(int $id, array $data): object;

    public function deleteFaq(int $id): bool;
}
