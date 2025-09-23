<?php

namespace App\Repositories\Brand;

use App\Repositories\Brand\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function query(): Builder
    {
        return Brand::query()->with('logo');
    }

    public function get(array $columns = ["*"], int $perPage = 15, array $filters = []): object
    {
        $q = $this->applyFilters($this->query()->select($columns), $filters);
        return $q->latest('id')->paginate($perPage);
    }

    public function all(): object
    {
        return $this->query()->get();
    }

    public function list(): object
    {
        return $this->query()->get();
    }

    public function find(int $id): object
    {
        return $this->query()->findOrFail($id);
    }

    public function view(int $id): object
    {
        $instance = $this->find($id);
        return $instance;
    }

    public function create(array $data): object
    {
        return Brand::create($data);
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
        return (bool) $instance->delete();
    }

    private function applyFilters(Builder $q, array $filters): Builder
    {
        if (!empty($filters['search'])) {
            $term = '%' . $filters['search'] . '%';
            $q->where('name', 'like', $term);
        }

        return $q;
    }
}
