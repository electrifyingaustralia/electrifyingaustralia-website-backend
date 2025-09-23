<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroResource;
use App\Models\Hero;
use Illuminate\Http\Request;

class ApiHeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::where('is_active', true)
            ->with('media')
            ->get();

        return HeroResource::collection($heroes);
    }
}
