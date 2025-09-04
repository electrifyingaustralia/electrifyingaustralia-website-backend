<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BenefitCreateRequest;
use App\Http\Requests\Backend\BenefitUpdateRequest;
use App\Services\Benefit\BenefitServiceInterface;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function __construct(protected BenefitServiceInterface $benefitService) {}

    public function index()
    {
        $benefits = $this->benefitService->get();
        return view('backend.benefit.index', compact('benefits'));
    }

    public function create()
    {
        return view('backend.benefit.create');
    }

    public function store(BenefitCreateRequest $request)
    {
        $data = $request->validated();
        $this->benefitService->createBenefit($data);

        return response()->json([
            'success' => true,
            'message' => 'Benefit created successfully!',
            'redirect' => route('admin.benefit.all')
        ]);
    }

    public function edit($id)
    {
        $benefit = $this->benefitService->findBenefit($id);
        return view('backend.benefit.edit', compact('benefit'));
    }

    public function update(BenefitUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->benefitService->updateBenefit($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Benefit updated successfully!',
            'redirect' => route('admin.benefit.all')
        ]);
    }

    public function destroy($id)
    {
        $this->benefitService->deleteBenefit($id);
        return redirect()->route('admin.benefit.all')->with('success', 'Benefit deleted successfully!');
    }
}
