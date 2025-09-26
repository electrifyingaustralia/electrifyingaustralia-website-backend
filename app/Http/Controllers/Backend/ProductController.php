<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCreateRequest;
use App\Http\Requests\Backend\ProductUpdateRequest;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductType\ProductTypeServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductServiceInterface $productService,
        protected ProductTypeServiceInterface $productTypeService,
        protected BrandRepositoryInterface $brandRepository
    ) {}

    public function index(Request $request)
    {
        $products = $this->productService->get(['*'], 15, [
            'type'   => $request->get('type'),
            'search' => $request->get('search'),
        ]);

        $productTypes = $this->productTypeService->get();
        return view('backend.product.index', compact('products', 'productTypes'));
    }

    public function create()
    {
        $brands = $this->brandRepository->all();
        $types = $this->productTypeService->get();
        return view('backend.product.create', compact('brands', 'types'));
    }

    public function store(ProductCreateRequest $request)
    {
        $data = $request->validated();
        $this->productService->createProduct($data);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully!',
            'redirect' => route('admin.product.all')
        ]);
    }

    public function edit($id)
    {
        $product = $this->productService->findProduct($id);
        $brands = $this->brandRepository->all();
        $types = $this->productTypeService->get();
        return view('backend.product.edit', compact('product', 'brands', 'types'));
    }

    public function show($id)
    {
        $product = $this->productService->findProduct($id);
        return view('backend.product.show', compact('product'));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->productService->updateProduct($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully!',
            'redirect' => route('admin.product.all')
        ]);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('admin.product.all')->with('success', 'Product Deleted Successfully!');
    }
}
