<?php

namespace App\Repositories\Hero;

use App\Repositories\Hero\HeroRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Hero;
use Illuminate\Support\Facades\Cache;

class HeroRepository implements HeroRepositoryInterface
{

    public const HERO_CACHE_KEY = "active_hero";

    public function __construct()
    {
        //
    }

    public function query(): Builder
    {
        return Hero::query();
    }

    public function get(array $columns = ["*"], int $perPage = 15, array $filters = []): object
    {
        $q = $this->applyFilters($this->query()->select($columns), $filters);
        return $q->latest('id')->paginate($perPage);
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

    public function view(int $id): object
    {
        $instance = $this->find($id);
        return $instance;
    }

    public function create(array $data)
    {
        $hero = Hero::create($data);
        Cache::forget(self::HERO_CACHE_KEY);
        return $hero;
    }

    public function update(int $id, array $data)
    {
        $instance = $this->find($id);
        $hero = $instance->update($data);
        Cache::forget(self::HERO_CACHE_KEY);
        return $hero;
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
        $deleted = $instance->delete();
        Cache::forget(self::HERO_CACHE_KEY);
        return $deleted;
    }

    private function applyFilters(Builder $q, array $filters): Builder
    {
        if (!empty($filters['search'])) {
            $term = '%' . $filters['search'] . '%';
            $q->where('title', 'like', $term);
        }

        return $q;
    }
}
