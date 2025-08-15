<?php

namespace App\Repositories\Contact;

use App\Repositories\Contact\ContactRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function query(): Builder{
        return Contact::query();
    }

    public function get(array $columns = ["*"], int $perPage = 15): object
    {
        return $this->query()->select($columns)->paginate($perPage);
    }

    public function all() : object
    {
        return $this->query()->all();
    }

    public function list() : object
    {
        return $this->query()->get();
    }

    public function find(int $id) : object
    {
        return $this->query()->findOrFail($id);
    }

    public function view(int $id) : object
    {
        $instance = $this->find($id);
        return $instance;
    }

    public function create(array $data) : object
    {
        return Contact::create($data);
    }

    public function update(int $id, array $data) : object
    {
        $instance = $this->find($id);
        $instance->update($data);
        return $instance;
    }

    public function exists(int | array $id): bool
    {
        if(is_array($id)){
            return $this->query()->where($id)->exists();
        }

        return $this->query()->where("id", $id)->exists();
    }

    public function delete(int $id): bool
    {
        $instance = $this->find($id);
        return true;
    }

}