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
        $products = Product::with(['type', 'brand'])
            ->where('is_active', true)
            ->when($request->filled('search') || $request->filled('type'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    if ($request->filled('search')) {
                        $query->where('name', 'LIKE', "%{$request->get('search')}%");
                    }

                    if ($request->filled('type')) {
                        $query->orWhereHas('type', function ($typeQuery) use ($request) {
                            $typeQuery->where('slug', $request->query('type'));
                        });
                    }
                });
            })
            ->inRandomOrder()
            ->limit(20)
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
}
