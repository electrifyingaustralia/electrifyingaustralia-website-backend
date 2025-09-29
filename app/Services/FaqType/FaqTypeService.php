<?php

namespace App\Services\FaqType;

use App\Repositories\FaqType\FaqTypeRepositoryInterface;
use App\Services\FaqType\FaqTypeServiceInterface;
use Illuminate\Support\Str;

class FaqTypeService implements FaqTypeServiceInterface
{
    public function __construct(protected FaqTypeRepositoryInterface $faqTypeRepository) {}

    public function get(array $columns = ['*'])
    {
        return $this->faqTypeRepository->get();
    }

    public function findFaqType(int $id): object
    {
        return $this->faqTypeRepository->find($id);
    }

    public function createFaqType(array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->faqTypeRepository->create($data);
    }

    public function updateFaqType(int $id, array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->faqTypeRepository->update($id, $data);
    }

    public function deleteFaqType(int $id): bool
    {
        return $this->faqTypeRepository->delete($id);
    }
}
