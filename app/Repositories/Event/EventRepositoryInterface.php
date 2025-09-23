<?php

namespace App\Repositories\Event;

use Illuminate\Database\Eloquent\Builder;

interface EventRepositoryInterface
{
    public function query(): Builder;
    public function get(array $columns = ["*"], int $perPage = 15, array $filters = []): object;
    public function all(): object;
    public function list(): object;
    public function find(int $id): object;
    public function view(int $id): object;
    public function create(array $data): object;
    public function update(int $id, array $data): object;
    public function exists(int $id): bool;
    public function delete(int $id): bool;
    public function attachImage(int $eventId, int $mediaId): void;
    public function detachImage(int $eventId, int $mediaId): void;
    public function syncImages(int $eventId, array $mediaIds): void;
    public function getImages(int $eventId);
}
