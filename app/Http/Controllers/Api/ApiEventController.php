<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventDetailsResource;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class ApiEventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::with(['media'])
            ->where('is_active', true)
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where('title', 'LIKE', "%{$request->get('search')}%")
                    ->orWhere('subtitle', 'LIKE', "%{$request->get('search')}%");
            })
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return EventResource::collection($events);
    }
    public function group()
    {
        $allEvents = Event::with('media')
            ->where('is_active', true)
            // ->inRandomOrder()
            ->limit(20)
            ->latest()
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

    public function show($slug)
    {
        $event = Event::with(['media', 'images'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return new EventDetailsResource($event);
    }
}
