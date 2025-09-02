<?php

namespace App\Services\Event;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

interface EventServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator;
    public function createEvent(array $data, ?UploadedFile $media = null): object;
    public function findEvent(int $id): object;
    public function updateEvent(int $id, array $data): object;
    public function deleteEvent(int $id): bool;
}
