<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PackageCreateRequest;
use App\Http\Requests\Backend\PackageUpdateRequest;
use App\Services\Package\PackageServiceInterface;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(protected PackageServiceInterface $packageService) {}

    public function index()
    {
        $packages = $this->packageService->get();
        return view('backend.package.index', compact('packages'));
    }

    public function create()
    {
        return view('backend.package.create');
    }

    public function store(PackageCreateRequest $request)
    {
        $data = $request->validated();
        $this->packageService->createPackage($data);
        return redirect()->route('admin.package.all')->with('success', 'Package created successfully!');
    }

    public function show($id)
    {
        $package = $this->packageService->getPackageWithFeatures($id);
        return view('backend.package.show', compact('package'));
    }

    public function edit($id)
    {
        $package = $this->packageService->findPackage($id);
        return view('backend.package.edit', compact('package'));
    }

    public function update(PackageUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->packageService->updatePackage($id, $data);
        return redirect()->route('admin.package.all')->with('success', 'Package updated successfully!');
    }

    public function destroy($id)
    {
        $this->packageService->deletePackage($id);
        return redirect()->route('admin.package.all')->with('success', 'Package Deleted Successfully!');
    }
}
