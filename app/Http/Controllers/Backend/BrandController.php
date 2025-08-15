<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BrandCreateRequest;
use App\Http\Requests\Backend\BrandUpdateRequest;
use App\Services\Brand\BrandServiceInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(protected BrandServiceInterface $brandService) {}

    public function index()
    {
        $brands = $this->brandService->getBrands();
        return view();
    }

    public function create()
    {
        return view();
    }

    public function store(BrandCreateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            //
        }

        $this->brandService->createBrand($data);
        return redirect();
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $brand = $this->brandService->findBrand($id);
        return view();
    }

    public function update(BrandUpdateRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            //
        }

        $this->brandService->updateBrand($id, $data);
        return redirect();
    }

    public function destroy($id)
    {
        $this->brandService->deleteBrand($id);
        return redirect();
    }
}
