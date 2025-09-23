<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EventCreateRequest;
use App\Http\Requests\Backend\EventUpdateRequest;
use App\Services\Event\EventServiceInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(protected EventServiceInterface $eventService) {}

    public function index(Request $request)
    {
        $events = $this->eventService->get(['*'], 15, [
            'search' => $request->get('search'),
        ]);
        return view('backend.event.index', compact('events'));
    }

    public function create()
    {
        return view('backend.event.create');
    }

    public function store(EventCreateRequest $request)
    {
        $data = $request->validated();
        $this->eventService->createEvent($data);

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'redirect' => route('admin.event.all')
        ]);
    }

    public function show($id)
    {
        $event = $this->eventService->findEvent($id);
        return view('backend.event.show', compact('event'));
    }

    public function edit($id)
    {
        $event = $this->eventService->findEvent($id);
        return view('backend.event.edit', compact('event'));
    }

    public function update(EventUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->eventService->updateEvent($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'redirect' => route('admin.event.all')
        ]);
    }

    public function destroy($id)
    {
        $this->eventService->deleteEvent($id);
        return redirect()->route('admin.event.all')->with('success', 'Event Deleted Successfully!');
    }

    public function assignImages($id)
    {
        $event = $this->eventService->findEvent($id);
        return view('backend.event.assign-images', compact('event'));
    }

    public function storeImages(Request $request, $id)
    {
        $request->validate([
            'media_ids' => 'required|array',
            'media_ids.*' => 'exists:media_libraries,id'
        ]);

        $this->eventService->syncEventImages($id, $request->media_ids);

        return response()->json([
            'success' => true,
            'message' => 'Images assigned successfully',
            'redirect' => route('admin.event.all')
        ]);
    }

    public function getEventImages($id)
    {
        $images = $this->eventService->getEventImages($id);
        return response()->json($images);
    }
}
