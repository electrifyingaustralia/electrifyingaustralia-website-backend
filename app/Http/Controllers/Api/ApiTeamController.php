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
        $teams = Team::select([
            "teams.name as team_name",
            "teams.slug as team_slug",
            "teams.designation as team_designation",
            "team_media.file_name as team_media_name",
            "team_media.disk as team_media_disk",
        ])
            ->join("media_libraries as team_media", "teams.media_id", "=", "team_media.id")
            ->where('status', true)
            ->orderBy('order', 'ASC')
            ->get();

        return TeamResource::collection($teams);
    }
}
