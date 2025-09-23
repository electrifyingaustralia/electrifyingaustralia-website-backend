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
        $products = Product::with(['media', 'brand', 'brand.logo'])
            ->where('is_active', true)
            ->orderBy('created_at', 'DESC')
            ->get();

        return ProductResource::collection($products);
    }
}
