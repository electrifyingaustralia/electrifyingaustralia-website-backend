<?php

namespace App\Services\Blog;

use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\Blog\BlogServiceInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogService implements BlogServiceInterface
{
    public function __construct(
        protected BlogRepositoryInterface $blogRepository,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->blogRepository->get($columns, $perPage, $filters);
    }

    public function createBlog(array $data, ?UploadedFile $media = null): object
    {
        if ($media) {

            $existingMedia = $this->mediaLibrary->query()->where('original_name', $media->getClientOriginalName())->first();

            if ($existingMedia) {
                $data['media_id'] = $existingMedia->id;
            } else {
                $uploaded = $this->mediaLibrary->upload($media);
                $data['media_id'] = $uploaded->id;
            }
        }

        return $this->blogRepository->create($data);
    }

    public function findBlog(int $id): object
    {
        return $this->blogRepository->find($id);
    }

    public function updateBlog(int $id, array $data): object
    {
        // $blog = $this->blogRepository->find($id);

        // Handle media_id from form data
        if (isset($data['media_id'])) {
            if (empty($data['media_id']) || $data['media_id'] === 'null') {
                $data['media_id'] = null;
            } else {
                // Verify the selected media exists
                $existingMedia = $this->mediaLibrary->findMedia($data['media_id']);
                if (!$existingMedia) {
                    $data['media_id'] = null;
                }
            }
        }

        // Ensure boolean values
        if (isset($data['is_active'])) {
            $data['is_active'] = (bool)$data['is_active'];
        }

        return $this->blogRepository->update($id, $data);
    }

    public function deleteBlog(int $id): bool
    {
        return $this->blogRepository->delete($id);
    }
}
