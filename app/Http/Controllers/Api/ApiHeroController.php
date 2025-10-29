<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroResource;
use App\Models\Hero;
use App\Repositories\Hero\HeroRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiHeroController extends Controller
{
    public function index()
    {
        $hero = Cache::rememberForever(HeroRepository::HERO_CACHE_KEY, function () {
            return Hero::where('is_active', true)
                ->latest()
                ->first();
        });
        if ($hero) return response()->json($hero->only(["title", "subtitle"]) + ["media_url" => $hero->media?->url]);
        return response()->json([
            'title' => null,
            'subtitle' => null,
            'media_url' => null,
        ]);
    }
}
