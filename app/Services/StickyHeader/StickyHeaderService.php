<?php

namespace App\Services\StickyHeader;

use App\Repositories\StickyHeader\StickyHeaderRepositoryInterface;
use App\Services\StickyHeader\StickyHeaderServiceInterface;
use Illuminate\Support\Str;

class StickyHeaderService implements StickyHeaderServiceInterface
{
    public function __construct(protected StickyHeaderRepositoryInterface $stickyHeaderRepository) {}

    public function get(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->stickyHeaderRepository->get($columns, $perPage);
    }

    public function createStickyHeader(array $data): object
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->stickyHeaderRepository->create($data);
    }

    public function findStickyHeader(int $id): object
    {
        return $this->stickyHeaderRepository->find($id);
    }

    public function updateStickyHeader(int $id, array $data): object
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->stickyHeaderRepository->update($id, $data);
    }

    public function deleteStickyHeader(int $id): bool
    {
        return $this->stickyHeaderRepository->delete($id);
    }
}
