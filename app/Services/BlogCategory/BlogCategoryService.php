<?php

namespace App\Services\BlogCategory;

use App\Repositories\BlogCategory\BlogCategoryRepositoryInterface;
use App\Services\BlogCategory\BlogCategoryServiceInterface;
use Illuminate\Support\Str;

class BlogCategoryService implements BlogCategoryServiceInterface
{
    public function __construct(protected BlogCategoryRepositoryInterface $blogCategoryRepository) {}

    public function get(array $columns = ['*'])
    {
        return $this->blogCategoryRepository->get();
    }

    public function findBlogCategory(int $id): object
    {
        return $this->blogCategoryRepository->find($id);
    }

    public function createBlogCategory(array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->blogCategoryRepository->create($data);
    }

    public function updateBlogCategory(int $id, array $data): object
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->blogCategoryRepository->update($id, $data);
    }

    public function deleteBlogCategory(int $id): bool
    {
        return $this->blogCategoryRepository->delete($id);
    }
}
