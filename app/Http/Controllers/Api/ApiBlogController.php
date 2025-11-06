<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class ApiBlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::select([
            "blogs.id as blog_id",
            "blogs.title as blog_title",
            "blogs.slug as blog_slug",
            "blogs.subtitle as blog_subtitle",
            "blogs.short_description as blog_short_description",
            "blogs.reading_time as blog_reading_time",
            //Blog Categories Table
            "blog_categories.name as blog_category_name",
            "blog_categories.slug as blog_category_slug",
            //Media Libraries Table
            "blog_media.file_name as blog_media_name",
            "blog_media.disk as blog_media_disk",
            "blog_media.alt_name as blog_media_alt_name",
        ])
            ->join("blog_categories", "blogs.blog_category_id", "=", "blog_categories.id")
            ->join("media_libraries as blog_media", "blogs.media_id", "=", "blog_media.id")
            ->where('is_active', true)

            ->when($request->filled('query'), function ($q) use ($request) {
                return $this->applySearch($q, $request->get("query"));
            })

            ->when($request->filled('category'), function ($q) use ($request) {
                return $this->applyCategoryFilter($q, $request->category);
            })

            ->when($request->filled('limit'), function ($q) use ($request) {
                return $q->limit($request->limit);
            }, function ($q) {
                return $q->limit(10);
            })
            ->orderBy("blogs.created_at")
            ->get();

        return BlogResource::collection($blogs);
    }

    private function applySearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('title', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        });
    }

    private function applyCategoryFilter($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }
}
