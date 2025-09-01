<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCreateRequest;
use App\Http\Requests\Backend\BlogUpdateRequest;
use App\Services\Blog\BlogServiceInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(protected BlogServiceInterface $blogService) {}
    public function index(Request $request)
    {
        $blogs = $this->blogService->get(['*'], 15, [
            'status' => $request->get('status'),
            'search' => $request->get('search'),
        ]);
        return view('Backend.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('backend.blog.create');
    }

    public function store(BlogCreateRequest $request)
    {
        $data = $request->validated();
        $this->blogService->createBlog($data);

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully',
            'redirect' => route('admin.blog.all')
        ]);
    }

    public function edit($id)
    {
        $blog = $this->blogService->findBlog($id);
        return view('Backend.blog.edit', compact('blog'));
    }

    public function update(BlogUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->blogService->updateBlog($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully',
            'redirect' => route('admin.blog.all')
        ]);
    }

    public function destroy($id)
    {
        $this->blogService->deleteBlog($id);
        return redirect()->route('admin.blog.all')->with('success', 'Blog Deleted Successfully!');
    }
}
