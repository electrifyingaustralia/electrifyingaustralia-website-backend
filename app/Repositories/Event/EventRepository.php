<?php

namespace App\Repositories\Event;

use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function query(): Builder
    {
        return Event::query();
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

    public function create(array $data): object
    {
        return Event::create($data);
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
            $q->where(function ($query) use ($term) {
                $query->where('title', 'like', $term)
                    ->orWhere('subtitle', 'like', $term);
            });
        }

        return $q;
    }

    public function attachImage(int $eventId, int $mediaId): void
    {
        $event = $this->find($eventId);
        $event->images()->attach($mediaId);
    }

    public function detachImage(int $eventId, int $mediaId): void
    {
        $event = $this->find($eventId);
        $event->images()->detach($mediaId);
    }

    public function syncImages(int $eventId, array $mediaIds): void
    {
        $event = $this->find($eventId);
        $event->images()->sync($mediaIds);
    }

    public function getImages(int $eventId)
    {
        $event = $this->find($eventId);
        return $event->images;
    }
}
