<?php

namespace App\Services\Brand;

use App\Repositories\Brand\BrandRepositoryInterface;
use App\Services\Brand\BrandServiceInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use Illuminate\Http\UploadedFile;

class BrandService implements BrandServiceInterface
{
    public function __construct(
        protected BrandRepositoryInterface $brandRepository,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function paginateListBrands(array $columns = ['*'], int $perPage = 15, array $filters = []): object
    {
        return $this->brandRepository->get($columns, $perPage, $filters);
    }

    public function createBrand(array $data, ?UploadedFile $logo = null): object
    {
        if ($logo) {
            $media = $this->mediaLibrary->upload($logo);
            $data['logo_id'] = $media->id;
        }

        return $this->brandRepository->create($data);
    }

    public function findBrand(int $id): object
    {
        return $this->brandRepository->find($id);
    }

    public function updateBrand(int $id, array $data, ?UploadedFile $logo = null): object
    {
        $brand = $this->brandRepository->find($id);
        if ($logo) {
            if ($brand->logo_id) {
                $this->mediaLibrary->delete($brand->logo_id);
            }

            $media = $this->mediaLibrary->upload($logo);
            $data['logo_id'] = $media->id;
        }

        return $this->brandRepository->update($id, $data);
    }

    public function deleteBrand(int $id): bool
    {
        return $this->brandRepository->delete($id);
    }
}
