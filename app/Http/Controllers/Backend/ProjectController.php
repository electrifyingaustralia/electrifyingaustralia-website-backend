<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProjectCreateRequest;
use App\Http\Requests\Backend\ProjectUpdateRequest;
use App\Services\Project\ProjectServiceInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(protected ProjectServiceInterface $projectService) {}

    public function index()
    {
        $projects = $this->projectService->get();
        return view('backend.project.index', compact('projects'));
    }

    public function create()
    {
        return view('backend.project.create');
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

    public function edit($id)
    {
        $project = $this->projectService->findProject($id);
        return view('backend.project.edit', compact('project'));
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
}
