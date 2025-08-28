<?php

namespace App\Services\StickyHeader;

interface StickyHeaderServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15): object;

    public function createStickyHeader(array $data): object;

    public function findStickyHeader(int $id): object;

    public function updateStickyHeader(int $id, array $data): object;

    public function deleteStickyHeader(int $id): bool;
}
