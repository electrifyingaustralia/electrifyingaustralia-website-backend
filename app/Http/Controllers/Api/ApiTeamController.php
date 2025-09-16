<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;

class ApiTeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('media')
            ->where('status', true)
            ->orderBy('name', 'ASC')
            ->get();

        return TeamResource::collection($teams);
    }
}
