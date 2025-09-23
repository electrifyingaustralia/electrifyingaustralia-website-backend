<?php

namespace App\Repositories\Award;

use Illuminate\Database\Eloquent\Builder;

interface AwardRepositoryInterface
{
    public function query(): Builder;
    public function get(array $columns = ["*"], int $perPage = 15): object;
    public function all(): object;
    public function list(): object;
    public function find(int $id): object;
    public function view(int $id): object;
    public function create(array $data): object;
    public function update(int $id, array $data): object;
    public function exists(int $id): bool;
    public function delete(int $id): bool;
}