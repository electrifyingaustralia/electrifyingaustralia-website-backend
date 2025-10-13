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
        $groupStart = Event::inRandomOrder()->first();

        $groupEnd = Event::inRandomOrder()
            ->when($groupStart, fn($query) => $query->whereNotIn("id", [$groupStart->id]))
            ->first();

        $ids = [];

        if ($groupStart) {
            $groupStart->makeHidden('media');
            $ids[] = $groupStart->id;
        }
        if ($groupEnd) {
            $groupEnd->makeHidden('media');
            $ids[] = $groupEnd->id;
        }

        $events = Event::with('media')
            ->whereNotIn("id", $ids)
            ->where('is_active', true)
            ->inRandomOrder()
            ->get()
            ->each(function ($event) {
                $event->makeHidden('media');
            });;

        return response()->json([
            "group_start" => $groupStart,
            "group_center" => $events,
            "group_end" => $groupEnd,
        ]);
    }
}
