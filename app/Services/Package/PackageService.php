<?php

namespace App\Services\Package;

use App\Repositories\Package\PackageRepositoryInterface;
use App\Services\Package\PackageServiceInterface;
use Illuminate\Support\Facades\DB;

class PackageService implements PackageServiceInterface
{
    public function __construct(protected PackageRepositoryInterface $packageRepository) {}

    public function get(array $columns = ['*'], int $perPage = 18)
    {
        return $this->packageRepository->get($columns, $perPage);
    }

    public function createPackage(array $data): object
    {
        // Start a database transaction
        return DB::transaction(function () use ($data) {
            // Create the package
            $package = $this->packageRepository->create([
                'name' => $data['name'],
                'subtitle' => $data['subtitle'],
                'is_best_deal' => $data['is_best_deal'] ?? false,
            ]);

            // Add features
            if (isset($data['features'])) {
                foreach ($data['features'] as $feature) {
                    $package->features()->create([
                        'feature' => $feature
                    ]);
                }
            }

            return $package;
        });
    }

    public function getPackageWithFeatures(int $id): object
    {
        return $this->packageRepository->query()->with('features')->findOrFail($id);
    }

    public function findPackage(int $id): object
    {
        return $this->packageRepository->find($id);
    }

    public function updatePackage(int $id, array $data): object
    {
        return DB::transaction(function () use ($id, $data) {
            // Update the package
            $package = $this->packageRepository->update($id, [
                'name' => $data['name'],
                'subtitle' => $data['subtitle'],
                'is_best_deal' => $data['is_best_deal'] ?? false,
            ]);

            // Remove existing features
            $package->features()->delete();

            // Add new features
            if (isset($data['features'])) {
                foreach ($data['features'] as $feature) {
                    if (!empty(trim($feature))) {
                        $package->features()->create([
                            'feature' => $feature
                        ]);
                    }
                }
            }

            return $package;
        });
    }

    public function deletePackage(int $id): bool
    {
        return $this->packageRepository->delete($id);
    }
}
