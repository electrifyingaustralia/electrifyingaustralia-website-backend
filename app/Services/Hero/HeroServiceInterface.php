<?php

namespace App\Services\Hero;

interface HeroServiceInterface
{
    public function getAllHero(array $columns = ["*"], int $perPage = 15): object;
    public function getHeroList(): object;
    public function findHero(int $id): object;
    public function createHero(array $data): object;
    public function updateHero(int $id, array $data): object;
    public function deleteHero(int $id): bool;
}
