<?php

namespace App\Services\Admin;

interface AdminServiceInterface
{
    public function getAdmins(array $columns = ["*"], int $perPage = 15): object;
    public function getAllAdmins(): object;
    public function getAdminsList(): object;
    public function findAdmin(int $id): object;
    public function createAdmin(array $data): object;
    public function updateAdmin(int $id, array $data): object;
    public function deleteAdmin(int $id): bool;
}
