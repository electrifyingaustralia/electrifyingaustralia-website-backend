<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class ApiEventController extends Controller
{
    public function index()
    {
        $allEvents = Event::with('media')
            ->where('is_active', true)
            ->inRandomOrder()
            ->get();

        $groupStart = $allEvents->shift();
        $groupEnd   = $allEvents->shift();
        $events     = $allEvents;

        return response()->json([
            "group_start" => $groupStart ? new EventResource($groupStart) : null,
            "group_center" => EventResource::collection($events),
            "group_end" => $groupEnd ? new EventResource($groupEnd) : null,
        ]);
    }
}
