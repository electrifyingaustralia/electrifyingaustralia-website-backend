<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function index()
    {
        $products = Product::select([
            // Products Table
            "products.id as product_id",
            "products.name as product_name",
            "products.slug as product_slug",
            "products.model_number as product_model_number",
            "products.short_description as product_short_description",
            "products.warranty as product_warranty",
            "products.is_featured as product_is_featured",
            "products.is_active as product_is_active",
            "products.product_link as product_product_link",
            "products.media_id as product_media_id",
            //Brands Tables
            "brands.id as brand_id",
            "brands.name as brand_name",
            "brands.logo_id as brand_logo_id",
            //Products_Types Table
            "product_types.id as product_type_id",
            "product_types.name as product_type_name",
            //Brand & Product Media Library Table
            "product_media.file_name as product_media_name",
            "brand_media.file_name as brand_media_name",

        ])
            ->join("brands", "products.brand_id", "=", "brands.id")
            ->join("product_types", "products.product_type_id", "=", "product_types.id")
            ->join("media_libraries as product_media", "products.media_id", "=", "product_media.id")
            ->join("media_libraries as brand_media", "brands.logo_id", "=", "brand_media.id")
            ->get();

        return ProductResource::collection($products);
    }
}
