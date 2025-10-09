<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;

class ApiPackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('features')
            ->orderBy('id', 'ASC')
            ->get();

        return PackageResource::collection($packages);
    }
}
