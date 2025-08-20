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

    public function index()
    {
        $brands = $this->brandService->getBrands();
        return view('Backend.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('backend.brands.create');
    }

    public function store(BrandCreateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadLogo($request->file('logo'));
        }

        $this->brandService->createBrand($data);

        return redirect()->route('admin.brands.all')->with('success', 'Brand created successfully!');
    }

    // public function show()
    // {
    //     //
    // }

    public function edit($id)
    {
        $brand = $this->brandService->findBrand($id);
        return view('backend.brands.edit', compact('brand'));
    }

    public function update(BrandUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $brand = $this->brandService->findBrand($id);
        if ($request->hasFile('logo')) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $data['logo'] = $this->uploadLogo($request->file('logo'));
        } else {
            $data['logo'] = $brand->logo;
        }

        $this->brandService->updateBrand($id, $data);
        return redirect()->route('admin.brands.all')->with('success', 'Brand Updated Successfully');
    }

    public function destroy($id)
    {
        $brand = $this->brandService->findBrand($id);
        if ($brand->logo) Storage::disk('public')->delete($brand->logo);
        $this->brandService->deleteBrand($id);
        return redirect()->route('admin.brands.all')->with('success', 'Brand deleted successfully!');
    }

    protected function uploadLogo($file): string
    {
        return $file->store('brands', 'public');
    }
}
