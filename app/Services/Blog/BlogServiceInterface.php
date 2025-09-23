<?php

namespace App\Services\Blog;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

interface BlogServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15, array $filters = []): LengthAwarePaginator;
    public function createBlog(array $data, ?UploadedFile $media = null): object;
    public function findBlog(int $id): object;
    public function updateBlog(int $id, array $data): object;
    public function deleteBlog(int $id): bool;
}
