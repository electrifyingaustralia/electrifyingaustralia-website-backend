<?php

namespace App\Services\MediaLibrary;

use App\Models\MediaLibrary;
use Illuminate\Http\UploadedFile;

interface MediaLibraryServiceInterface
{
    public function paginateList(int $perPage = 24, array $filters = []);

    public function query();

    public function findMedia(int $id);

    public function upload(UploadedFile $file, string $disk = 'public'): MediaLibrary;

    public function delete(int $id): bool;
}
