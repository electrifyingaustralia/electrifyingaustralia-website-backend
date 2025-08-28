<?php

namespace App\Services\Faq;

use App\Repositories\Faq\FaqRepositoryInterface;
use App\Services\Faq\FaqServiceInterface;

class FaqService implements FaqServiceInterface
{
    public function __construct(protected FaqRepositoryInterface $faqRepository) {}

    public function get(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->faqRepository->get($columns, $perPage);
    }

    public function createFaq(array $data): object
    {
        return $this->faqRepository->create($data);
    }

    public function findFaq(int $id): object
    {
        return $this->faqRepository->find($id);
    }

    public function updateFaq(int $id, array $data): object
    {
        return $this->faqRepository->update($id, $data);
    }

    public function deleteFaq(int $id): bool
    {
        return $this->faqRepository->delete($id);
    }
}
