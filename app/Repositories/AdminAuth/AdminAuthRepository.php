<?php

namespace App\Repositories\AdminAuth;

use App\Repositories\AdminAuth\AdminAuthRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Admin;

class AdminAuthRepository implements AdminAuthRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function query(): Builder
    {
        return Admin::query();
    }

    public function get(array $columns = ["*"], int $perPage = 15): object
    {
        return $this->query()->select($columns)->paginate($perPage);
    }

    public function all(): object
    {
        return $this->query()->all();
    }

    public function list(): object
    {
        return $this->query()->get();
    }

    public function find(int $id): object
    {
        return $this->query()->findOrFail($id);
    }

    public function findByEmail(string $email): object
    {
        return $this->query()->where('email', $email)->firstOrFail();
    }

    public function view(int $id): object
    {
        $instance = $this->find($id);
        return $instance;
    }

    public function create(array $data): object
    {
        return Admin::create($data);
    }

    public function update(int $id, array $data): object
    {
        $instance = $this->find($id);
        $instance->update($data);
        return $instance;
    }

    public function exists(int | array $id): bool
    {
        if (is_array($id)) {
            return $this->query()->where($id)->exists();
        }

        return $this->query()->where("id", $id)->exists();
    }

    public function delete(int $id): bool
    {
        $instance = $this->find($id);
        return $instance->delete();
    }
}
