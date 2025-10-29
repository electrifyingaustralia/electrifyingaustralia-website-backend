<?php

namespace App\Services\Hero;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;


interface HeroServiceInterface
{
    public function get(array $columns = ["*"], int $perPage = 15, array $filters = []): LengthAwarePaginator;
    public function getHeroList(): object;
    public function findHero(int $id): object;
    public function createHero(array $data, ?UploadedFile $media = null);
    public function updateHero(int $id, array $data);
    public function deleteHero(int $id): bool;
}
