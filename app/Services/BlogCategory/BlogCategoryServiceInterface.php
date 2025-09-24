<?php

namespace App\Services\BlogCategory;

interface BlogCategoryServiceInterface
{
    public function get(array $columns = ['*']);
    public function findBlogCategory(int $id): object;
    public function createBlogCategory(array $data): object;
    public function updateBlogCategory(int $id, array $data): object;
    public function deleteBlogCategory(int $id): bool;
}
