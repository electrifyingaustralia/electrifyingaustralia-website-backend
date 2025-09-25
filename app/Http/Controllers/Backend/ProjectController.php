<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProjectCreateRequest;
use App\Http\Requests\Backend\ProjectUpdateRequest;
use App\Services\Project\ProjectServiceInterface;
use App\Services\ProjectCategory\ProjectCategoryServiceInterface;
use App\Services\ProjectType\ProjectTypeServiceInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectServiceInterface $projectService,
        protected ProjectCategoryServiceInterface $projectCategoryService,
        protected ProjectTypeServiceInterface $projectTypeService
    ) {}

    public function index()
    {
        $projects = $this->projectService->get();
        return view('backend.project.index', compact('projects'));
    }

    public function create()
    {
        $categories = $this->projectCategoryService->get();
        $types = $this->projectTypeService->get();
        return view('backend.project.create', compact('categories', 'types'));
    }

    public function store(ProjectCreateRequest $request)
    {
        $data = $request->validated();
        $this->projectService->createProject($data);

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully',
            'redirect' => route('admin.project.all')
        ]);
    }

    public function show($id)
    {
        $project = $this->projectService->findProject($id);
        return view('backend.project.show', compact('project'));
    }

    public function edit($id)
    {
        $project = $this->projectService->findProject($id);
        $categories = $this->projectCategoryService->get();
        $types = $this->projectTypeService->get();
        return view('backend.project.edit', compact('project', 'categories', 'types'));
    }

    public function update(ProjectUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->projectService->updateProject($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully',
            'redirect' => route('admin.project.all')
        ]);
    }

    public function destroy($id)
    {
        $this->projectService->deleteProject($id);
        return redirect()->route('admin.project.all')->with('success', 'Project Deleted Successfully!');
    }

    public function assignImages($id)
    {
        $project = $this->projectService->findProject($id);
        return view('backend.project.assign-images', compact('project'));
    }

    public function storeImages(Request $request, $id)
    {
        $request->validate([
            'media_ids' => 'required|array',
            'media_ids.*' => 'exists:media_libraries,id'
        ]);

        $this->projectService->syncProjectImages($id, $request->media_ids);

        return response()->json([
            'success' => true,
            'message' => 'Images assigned successfully',
            'redirect' => route('admin.project.all')
        ]);
    }

    public function getProjectImages($id)
    {
        $images = $this->projectService->getProjectImages($id);
        return response()->json($images);
    }
}
