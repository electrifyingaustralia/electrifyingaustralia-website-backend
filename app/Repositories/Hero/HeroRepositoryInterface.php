<?php

namespace App\Repositories\Hero;

use Illuminate\Database\Eloquent\Builder;

interface HeroRepositoryInterface
{
    public function query(): Builder;
    public function get(array $columns = ["*"], int $perPage = 15, array $filters = []): object;
    public function all(): object;
    public function list(): object;
    public function find(int $id): object;
    public function view(int $id): object;
    public function create(array $data);
    public function update(int $id, array $data);
    public function exists(int $id): bool;
    public function delete(int $id): bool;
}
