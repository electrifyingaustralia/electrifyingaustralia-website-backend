<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class ApiBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with('logo')
            ->whereNotNull('logo_id')
            ->orderBy('name', 'ASC')
            ->get();

        return response()->json(["data" => $brands, "custom" => true]);

        return BrandResource::collection($brands);
    }
}
