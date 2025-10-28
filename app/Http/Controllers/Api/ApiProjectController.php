<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ApiProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('media')
            ->when($request->filled('category'), function ($q) use ($request) {
                $q->where('category', $request->category);
            })
            ->when($request->filled('home'), function ($q) use ($request) {
                $isSolution = filter_var($request->home, FILTER_VALIDATE_BOOLEAN);
                $q->where('is_solution', $isSolution);
            })
            ->latest()
            ->get();

        return ProjectResource::collection($projects);
    }
}
