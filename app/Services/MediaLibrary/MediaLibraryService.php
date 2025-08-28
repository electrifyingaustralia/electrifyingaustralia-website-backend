<?php

namespace App\Services\MediaLibrary;

use App\Models\MediaLibrary;
use App\Repositories\MediaLibrary\MediaLibraryRepositoryInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaLibraryService implements MediaLibraryServiceInterface
{
    public function __construct(private MediaLibraryRepositoryInterface $mediaLibrary) {}

    public function query()
    {
        return $this->mediaLibrary->query();
    }

    public function paginateList(int $perPage = 24, array $filters = [])
    {
        return $this->mediaLibrary->get(['*'], $perPage, $filters);
    }

    public function upload(UploadedFile $file, string $disk = 'public'): MediaLibrary
    {
        $mime = $file->getMimeType();
        $type = str_starts_with($mime, 'image/') ? 'image' : (str_starts_with($mime, 'video/') ? 'video' : 'other');

        $storedPath = $file->store('media', $disk);

        return $this->mediaLibrary->create([
            'file_name'     => basename($storedPath),
            'original_name' => $file->getClientOriginalName(),
            'file_path'     => $storedPath,
            'disk'          => $disk,
            'file_type'     => $type,
            'mime_type'     => $mime,
            'file_size'     => $file->getSize(),
        ]);
    }

    public function delete(int $id): bool
    {
        $media = $this->mediaLibrary->find($id);
        Storage::disk($media->disk)->delete($media->file_path);
        return $this->mediaLibrary->delete($id);
    }
}
