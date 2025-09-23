<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BenefitResource;
use App\Models\Benefit;
use Illuminate\Http\Request;

class ApiBenefitController extends Controller
{
    public function index()
    {
        $benefits = Benefit::with('media')
            ->where('is_active', true)
            ->orderBy('created_at', 'DESC')
            ->get();

        return BenefitResource::collection($benefits);
    }
}
