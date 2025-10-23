<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCreateRequest;
use App\Http\Requests\Backend\BlogUpdateRequest;
use App\Services\Blog\BlogServiceInterface;
use App\Services\BlogCategory\BlogCategoryServiceInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(
        protected BlogServiceInterface $blogService,
        protected BlogCategoryServiceInterface $blogCategoryServiceInterface
    ) {}
    public function index(Request $request)
    {
        $blogs = $this->blogService->get(['*'], 15, [
            'status' => $request->get('status'),
            'search' => $request->get('search'),
        ]);
        return view('backend.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = $this->blogCategoryServiceInterface->get();
        return view('backend.blog.create', compact('categories'));
    }

    public function store(BlogCreateRequest $request)
    {
        $data = $request->validated();
        $this->blogService->createBlog($data);

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully!',
            'redirect' => route('admin.blog.all')
        ]);
    }

    public function show($id)
    {
        $blog = $this->blogService->findBlog($id);
        return view('backend.blog.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = $this->blogService->findBlog($id);
        $categories = $this->blogCategoryServiceInterface->get();
        return view('backend.blog.edit', compact('blog', 'categories'));
    }

    public function update(BlogUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->blogService->updateBlog($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully!',
            'redirect' => route('admin.blog.all')
        ]);
    }

    public function destroy($id)
    {
        $this->blogService->deleteBlog($id);
        return redirect()->route('admin.blog.all')->with('success', 'Blog Deleted Successfully!');
    }
}
