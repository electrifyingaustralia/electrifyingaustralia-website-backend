<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectDetailsResource;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiProjectController extends Controller
{
    public function index(Request $request)
    {
        // DB::enableQueryLog();
        $projects = Project::select([
            "projects.id as project_id",
            "projects.title as project_title",
            "projects.slug as project_slug",
            "projects.subtitle as project_subtitle",
            "projects.location as project_location",
            "projects.category as project_category",
            "projects.is_solution as project_is_solution",
            //Project Types Table
            "project_types.name as project_type_name",
            //Media Libraries Table
            "project_media.file_name as project_media_name",
            "project_media.disk as project_media_disk",
            "project_media.alt_name as project_media_alt_name",
        ])
            ->join("project_types", "projects.project_type_id", "=", "project_types.id")
            ->join("media_libraries as project_media", "projects.media_id", "=", "project_media.id")

            ->when($request->filled('category'), function ($q) use ($request) {
                $q->where('category', $request->category);
            })
            ->when($request->filled('home'), function ($q) use ($request) {
                $isSolution = filter_var($request->home, FILTER_VALIDATE_BOOLEAN);
                $q->where('is_solution', $isSolution);
            })
            ->latest("projects.created_at")
            ->limit(20)
            ->get();
        // dd(DB::getQueryLog());

        return ProjectResource::collection($projects);
    }

    public function show($slug)
    {
        $project = Project::with(['media', 'images', 'type'])
            ->where('slug', $slug)
            ->firstOrFail();

        return new ProjectDetailsResource($project);
    }
}
