<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCategoryRequest;
use App\Services\BlogCategory\BlogCategoryServiceInterface;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function __construct(protected BlogCategoryServiceInterface $blogCategoryService) {}

    public function index()
    {
        $categories = $this->blogCategoryService->get();
        return view('Backend.blog-category.index', compact('categories'));
    }

    public function store(BlogCategoryRequest $request)
    {
        $this->blogCategoryService->createBlogCategory($request->all());
        return redirect()->route('admin.blog-category.all')->with('success', 'Blog category created successfully!');
    }

    public function edit($id)
    {
        $categoryToEdit = $this->blogCategoryService->findBlogCategory($id);
        $categories = $this->blogCategoryService->get();
        return view('Backend.blog-category.index', compact('categoryToEdit', 'categories'));
    }

    public function update(BlogCategoryRequest $request, $id)
    {
        $this->blogCategoryService->updateBlogCategory($id, $request->all());
        return redirect()->route('admin.blog-category.all')->with('success', 'Blog category updated successfully!');
    }

    public function delete($id)
    {
        $this->blogCategoryService->deleteBlogCategory($id);
        return redirect()->route('admin.blog-category.all')->with('success', 'Blog category deleted successfully.');
    }
}
