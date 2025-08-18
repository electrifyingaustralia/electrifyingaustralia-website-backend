<?php

namespace App\Services\Hero;

use App\Repositories\Hero\HeroRepositoryInterface;
use App\Services\Hero\HeroServiceInterface;

class HeroService implements HeroServiceInterface
{
    public function __construct(protected HeroRepositoryInterface $heroRepository) {}

    public function getAllHero(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->heroRepository->get($columns, $perPage);
    }

    public function getHeroList(): object
    {
        return $this->heroRepository->list();
    }

    public function findHero(int $id): object
    {
        return $this->heroRepository->find($id);
    }

    public function createHero(array $data): object
    {
        //* video
        return $this->heroRepository->create($data);
    }

    public function updateHero(int $id, array $data): object
    {
        //* video
        return $this->heroRepository->update($id, $data);
    }

    public function deleteHero(int $id): bool
    {
        //* video
        return $this->heroRepository->delete($id);
    }
}
