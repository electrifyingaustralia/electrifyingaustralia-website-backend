<?php

namespace App\Services\SolutionCard;

use App\Repositories\SolutionCard\SolutionCardRepositoryInterface;
use App\Services\SolutionCard\SolutionCardServiceInterface;
use Illuminate\Support\Str;

class SolutionCardService implements SolutionCardServiceInterface
{
    public function __construct(protected SolutionCardRepositoryInterface $solutionCardRepository) {}

    public function get(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->solutionCardRepository->get($columns, $perPage);
    }

    public function createSolutionCard(array $data): object
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->solutionCardRepository->create($data);
    }

    public function findSolutionCard(int $id): object
    {
        return $this->solutionCardRepository->find($id);
    }

    public function updateSolutionCard(int $id, array $data): object
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->solutionCardRepository->update($id, $data);
    }

    public function deleteSolutionCard(int $id): bool
    {
        return $this->solutionCardRepository->delete($id);
    }
}
