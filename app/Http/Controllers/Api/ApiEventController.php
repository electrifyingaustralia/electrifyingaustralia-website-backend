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
        $events = Event::with('media')
            ->where('is_active', true)
            ->orderBy('created_at', 'DESC')
            ->get();

        return EventResource::collection($events);
    }
}
