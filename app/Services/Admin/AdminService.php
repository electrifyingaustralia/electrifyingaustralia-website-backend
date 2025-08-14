<?php

namespace App\Services\Admin;

use App\Repositories\AdminAuth\AdminAuthRepositoryInterface;
use App\Services\Admin\AdminServiceInterface;

class AdminService implements AdminServiceInterface
{
    public function __construct(protected AdminAuthRepositoryInterface $admin) {}

    public function getAdmins(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->admin->get($columns, $perPage);
    }

    public function getAllAdmins(): object
    {
        return $this->admin->all();
    }

    public function getAdminsList(): object
    {
        return $this->admin->list();
    }

    public function findAdmin(int $id): object
    {
        return $this->admin->find($id);
    }

    public function createAdmin(array $data): object
    {
        return $this->admin->create($data);
    }

    public function updateAdmin(int $id, array $data): object
    {
        return $this->admin->update($id, $data);
    }

    public function deleteAdmin(int $id): bool
    {
        return $this->admin->delete($id);
    }
}
