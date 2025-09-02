<?php

namespace App\Services\Package;

interface PackageServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 18);
    public function createPackage(array $data): object;
    public function findPackage(int $id): object;
    public function getPackageWithFeatures(int $id): object;
    public function updatePackage(int $id, array $data): object;
    public function deletePackage(int $id): bool;
}
