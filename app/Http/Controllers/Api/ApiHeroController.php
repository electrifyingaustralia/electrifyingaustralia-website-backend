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
        $hero = Hero::where('is_active', true)
            ->latest()
            ->first();
        return response()->json($hero->only(["title", "subtitle", "media_url"]));
    }
}
