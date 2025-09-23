<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SolutionCardResource;
use App\Models\SolutionCard;
use Illuminate\Http\Request;

class ApiSolutionCardController extends Controller
{
    public function index()
    {
        $solutionCards = SolutionCard::latest()->get();

        return SolutionCardResource::collection($solutionCards);
    }
}
