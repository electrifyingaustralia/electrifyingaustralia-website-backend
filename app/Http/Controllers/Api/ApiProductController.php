<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductTypeResource;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function index(Request $request)
    {

        $type = ProductType::when($request->filled('type'), function ($query) use ($request) {
            $query->where('slug', $request->query('type'));
        }, function ($query) {
            $query->orderBy("id", "ASC");
        })->first();

        $products = Product::with('type')
            ->where('product_type_id', $type->id ?? 0)
            ->where('is_active', true)
            ->latest()
            ->get();

        return ProductResource::collection($products);
    }

    public function getProductTypes()
    {
        $types = ProductType::withCount('products')
            ->latest()
            ->get();

        return ProductTypeResource::collection($types);
    }

    public function getProductsByType($slug)
    {
        $type = ProductType::where('slug', $slug)->first();

        if (!$type) {
            return response()->json([
                'message' => 'Type not found'
            ], 404);
        }

        $products = Product::with(['media', 'brand', 'type'])
            ->where('product_type_id', $type->id)
            ->where('is_active', true)
            ->latest()
            ->get();

        return response()->json([
            'type' => new ProductTypeResource($type),
            'products' => ProductResource::collection($products)
        ]);
    }

    private function applyTypeFilter($query, $typeSlug)
    {
        return $query->whereHas('type', function ($q) use ($typeSlug) {
            $q->where('slug', $typeSlug);
        });
    }
}
