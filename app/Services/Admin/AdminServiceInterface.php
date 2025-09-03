<?php

namespace App\Services\Admin;

use Illuminate\Http\UploadedFile;


interface AdminServiceInterface
{
    public function getAdmins(array $columns = ["*"], int $perPage = 15): object;
    public function getAllAdmins(): object;
    public function getAdminsList(): object;
    public function findAdmin(int $id): object;
    public function createAdmin(array $data, ?UploadedFile $media = null): object;
    public function updateAdmin(int $id, array $data): object;
    public function deleteAdmin(int $id): bool;
}
