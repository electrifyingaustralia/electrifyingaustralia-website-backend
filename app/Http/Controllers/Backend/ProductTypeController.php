<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductTypeRequest;
use App\Services\ProductType\ProductTypeServiceInterface;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function __construct(protected ProductTypeServiceInterface $productTypeService) {}

    public function index()
    {
        $types = $this->productTypeService->get();
        return view('backend.product-type.index', compact('types'));
    }

    public function store(ProductTypeRequest $request)
    {
        $this->productTypeService->createProductType($request->all());
        return redirect()->route('admin.product-type.all')->with('success', 'Product type created successfully!');
    }

    public function edit($id)
    {
        $typeToEdit = $this->productTypeService->findProductType($id);
        $types = $this->productTypeService->get();
        return view('backend.product-type.index', compact('typeToEdit', 'types'));
    }

    public function update(ProductTypeRequest $request, $id)
    {
        $this->productTypeService->updateProductType($id, $request->all());
        return redirect()->route('admin.product-type.all')->with('success', 'Product type updated successfully!');
    }

    public function delete($id)
    {
        $this->productTypeService->deleteProductType($id);
        return redirect()->route('admin.product-type.all')->with('success', 'Product type deleted successfully.');
    }
}
