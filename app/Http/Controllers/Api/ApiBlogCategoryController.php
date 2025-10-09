<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCategoryResource;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class ApiBlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('blogs')
            ->latest()
            ->get();

        return BlogCategoryResource::collection($categories);
    }

    public function getBlogsByCategory($slug)
    {
        $category = BlogCategory::where('slug', $slug)->first();

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $blogs = Blog::with(['media', 'category'])
            ->where('blog_category_id', $category->id)
            ->where('is_active', true)
            ->latest()
            ->get();

        return response()->json([
            'category' => new BlogCategoryResource($category),
            'blogs' => BlogResource::collection($blogs)
        ]);
    }
}
