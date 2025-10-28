<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProjectCategoryRequest;
use App\Services\ProjectCategory\ProjectCategoryServiceInterface;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    public function __construct(protected ProjectCategoryServiceInterface $projectCategoryService) {}

    public function index()
    {
        $categories = $this->projectCategoryService->get();
        return view('backend.project-category.index', compact('categories'));
    }

    public function store(ProjectCategoryRequest $request)
    {
        $this->projectCategoryService->createProjectCategory($request->all());
        return redirect()->route('admin.project-category.all')->with('success', 'Project category created successfully!');
    }

    public function edit($id)
    {
        $categoryToEdit = $this->projectCategoryService->findProjectCategory($id);
        $categories = $this->projectCategoryService->get();
        return view('backend.project-category.index', compact('categoryToEdit', 'categories'));
    }

    public function update(ProjectCategoryRequest $request, $id)
    {
        $this->projectCategoryService->updateProjectCategory($id, $request->all());
        return redirect()->route('admin.project-category.all')->with('success', 'Project category updated successfully!');
    }

    public function delete($id)
    {
        $this->projectCategoryService->deleteProjectCategory($id);
        return redirect()->route('admin.project-category.all')->with('success', 'Project category deleted successfully.');
    }
}
