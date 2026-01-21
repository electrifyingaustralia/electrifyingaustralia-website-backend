<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailsResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductTypeResource;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::select([
            // Products Table
            "products.id as product_id",
            "products.name as product_name",
            "products.slug as product_slug",
            "products.model_number as product_model_number",
            "products.short_description as product_short_description",
            "products.is_featured as product_is_featured",
            "products.is_active as product_is_active",
            "products.product_link as product_product_link",
            "products.media_id as product_media_id",
            "products.meta_title as product_meta_title",
            "products.meta_description as product_meta_description",
            "products.keywords as product_keywords",
            //Brands Tables
            "brands.id as brand_id",
            "brands.name as brand_name",
            "brands.logo_id as brand_logo_id",
            //Products_Types Table
            "product_types.id as product_type_id",
            "product_types.name as product_type_name",
            "product_types.meta_title as product_type_meta_title",
            "product_types.meta_description as product_type_meta_description",
            "product_types.keywords as product_type_keywords",
            //Brand & Product Media Library Table
            "product_media.file_name as product_media_name",
            "product_media.disk as product_media_disk",
            "product_media.alt_name as product_media_alt_name",

            "brand_media.file_name as brand_media_name",
            "brand_media.disk as brand_media_disk",
            "brand_media.alt_name as brand_media_alt_name",

        ])
            ->join("brands", "products.brand_id", "=", "brands.id")
            ->join("product_types", "products.product_type_id", "=", "product_types.id")
            ->join("media_libraries as product_media", "products.media_id", "=", "product_media.id")
            ->join("media_libraries as brand_media", "brands.logo_id", "=", "brand_media.id")
            ->where('is_active', true)
            ->when($request->filled('search') || $request->filled('type'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    if ($request->filled('search')) {
                        $query->where('products.name', 'LIKE', "%{$request->get('search')}%");
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

    public function show($slug)
    {
        $product = Product::with(['media', 'brand', 'type', 'attributes', 'images'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return new ProductDetailsResource($product);
    }

    public function getSuggestedProducts($slug)
    {
        $currentProduct = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $suggestedProducts = collect();

        // Step 1: Get same-type products first (priority)
        $sameTypeProducts = Product::select([
            "products.id as product_id",
            "products.name as product_name",
            "products.slug as product_slug",
            "products.model_number as product_model_number",
            "products.short_description as product_short_description",
            "products.is_featured as product_is_featured",
            "products.is_active as product_is_active",
            "products.product_link as product_product_link",
            "products.media_id as product_media_id",
            "products.meta_title as product_meta_title",
            "products.meta_description as product_meta_description",
            "products.keywords as product_keywords",

            "brands.id as brand_id",
            "brands.name as brand_name",
            "brands.logo_id as brand_logo_id",

            "product_types.id as product_type_id",
            "product_types.name as product_type_name",
            "product_types.meta_title as product_type_meta_title",
            "product_types.meta_description as product_type_meta_description",
            "product_types.keywords as product_type_keywords",

            "product_media.file_name as product_media_name",
            "product_media.disk as product_media_disk",
            "product_media.alt_name as product_media_alt_name",

            "brand_media.file_name as brand_media_name",
            "brand_media.disk as brand_media_disk",
            "brand_media.alt_name as brand_media_alt_name",
        ])
            ->join("brands", "products.brand_id", "=", "brands.id")
            ->join("product_types", "products.product_type_id", "=", "product_types.id")
            ->join("media_libraries as product_media", "products.media_id", "=", "product_media.id")
            ->join("media_libraries as brand_media", "brands.logo_id", "=", "brand_media.id")
            ->where('products.is_active', true)
            ->where('products.product_type_id', $currentProduct->product_type_id)
            ->where('products.id', '!=', $currentProduct->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $suggestedProducts = $suggestedProducts->merge($sameTypeProducts);

        // Step 2: If we need more products, get from other types
        if ($suggestedProducts->count() < 4) {
            $remainingCount = 4 - $suggestedProducts->count();

            // Get IDs of already selected products to exclude
            $excludeIds = $suggestedProducts->pluck('product_id')->toArray();
            $excludeIds[] = $currentProduct->id;

            $otherTypeProducts = Product::select([
                "products.id as product_id",
                "products.name as product_name",
                "products.slug as product_slug",
                "products.model_number as product_model_number",
                "products.short_description as product_short_description",
                "products.is_featured as product_is_featured",
                "products.is_active as product_is_active",
                "products.product_link as product_product_link",
                "products.media_id as product_media_id",
                "products.meta_title as product_meta_title",
                "products.meta_description as product_meta_description",
                "products.keywords as product_keywords",

                "brands.id as brand_id",
                "brands.name as brand_name",
                "brands.logo_id as brand_logo_id",

                "product_types.id as product_type_id",
                "product_types.name as product_type_name",
                "product_types.meta_title as product_type_meta_title",
                "product_types.meta_description as product_type_meta_description",
                "product_types.keywords as product_type_keywords",

                "product_media.file_name as product_media_name",
                "product_media.disk as product_media_disk",
                "product_media.alt_name as product_media_alt_name",

                "brand_media.file_name as brand_media_name",
                "brand_media.disk as brand_media_disk",
                "brand_media.alt_name as brand_media_alt_name",
            ])
                ->join("brands", "products.brand_id", "=", "brands.id")
                ->join("product_types", "products.product_type_id", "=", "product_types.id")
                ->join("media_libraries as product_media", "products.media_id", "=", "product_media.id")
                ->join("media_libraries as brand_media", "brands.logo_id", "=", "brand_media.id")
                ->where('products.is_active', true)
                ->where('products.product_type_id', '!=', $currentProduct->product_type_id)
                ->whereNotIn('products.id', $excludeIds)
                ->inRandomOrder()
                ->limit($remainingCount)
                ->get();

            $suggestedProducts = $suggestedProducts->merge($otherTypeProducts);
        }

        return response()->json([
            'data' => ProductResource::collection($suggestedProducts),
        ]);
    }
}
