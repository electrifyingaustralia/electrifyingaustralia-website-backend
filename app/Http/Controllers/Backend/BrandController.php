<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BrandCreateRequest;
use App\Http\Requests\Backend\BrandUpdateRequest;
use App\Services\Brand\BrandServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function __construct(protected BrandServiceInterface $brandService) {}

    public function index(Request $request)
    {
        $brands = $this->brandService->paginateListBrands(['*'], 15, [
            'search' => $request->get('search'),
        ]);
        return view('Backend.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('backend.brands.create');
    }

    public function store(BrandCreateRequest $request)
    {
        $data = $request->validated();
        $this->brandService->createBrand(
            $data,
            $request->hasFile('logo') ? $request->file('logo') : null
        );

        return response()->json([
            'success' => true,
            'message' => 'Brand created successfully',
            'redirect' => route('admin.brands.all')
        ]);
    }

    public function edit($id)
    {
        $brand = $this->brandService->findBrand($id);
        return view('backend.brands.edit', compact('brand'));
    }

    public function update(BrandUpdateRequest $request, $id)
    {

        $this->brandService->updateBrand($id, $request->validated(), $request->file('logo'));
        return response()->json([
            'success' => true,
            'message' => 'Brand updated successfully',
            'redirect' => route('admin.brands.all')
        ]);
    }

    public function destroy($id)
    {
        $this->brandService->deleteBrand($id);

        return redirect()->route('admin.brands.all');
    }
}
