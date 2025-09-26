<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProjectTypeRequest;
use App\Services\ProjectType\ProjectTypeServiceInterface;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    public function __construct(protected ProjectTypeServiceInterface $projectTypeService) {}

    public function index()
    {
        $types = $this->projectTypeService->get();
        return view('Backend.project-type.index', compact('types'));
    }

    public function store(ProjectTypeRequest $request)
    {
        $this->projectTypeService->createProjectType($request->all());
        return redirect()->route('admin.project-type.all')->with('success', 'Project type created successfully!');
    }

    public function edit($id)
    {
        $typeToEdit = $this->projectTypeService->findProjectType($id);
        $types = $this->projectTypeService->get();
        return view('Backend.project-type.index', compact('typeToEdit', 'types'));
    }

    public function update(ProjectTypeRequest $request, $id)
    {
        $this->projectTypeService->updateProjectType($id, $request->all());
        return redirect()->route('admin.project-type.all')->with('success', 'Project type updated successfully!');
    }

    public function delete($id)
    {
        $this->projectTypeService->deleteProjectType($id);
        return redirect()->route('admin.project-type.all')->with('success', 'Project type deleted successfully.');
    }
}
