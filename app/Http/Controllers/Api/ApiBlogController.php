<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class ApiBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('media')
            ->where('is_active', true)
            ->latest()
            ->get();

        return BlogResource::collection($blogs);
    }
}
