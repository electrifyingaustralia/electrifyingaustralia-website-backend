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
        $blogs = Blog::with(['media', 'category'])
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
            ->latest()
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
