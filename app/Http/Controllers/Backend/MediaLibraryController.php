<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MediaCreateRequest;
use App\Services\MediaLibrary\MediaLibraryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaLibraryController extends Controller
{
    public function __construct(protected MediaLibraryService $mediaLibrary) {}

    public function index(Request $request): View
    {
        $medias = $this->mediaLibrary->paginateList(24, [
            'type'   => $request->get('type'),
            'search' => $request->get('search'),
        ]);

        return view('backend.media.index', compact('medias'));
    }

    public function store(MediaCreateRequest $request): JsonResponse
    {
        $saved = [];
        $files = $request->file('files');
        $altNames = $request->input('alt_name', []);

        foreach ($files as $index => $file) {
            $altName = $altNames[$index] ?? null;
            $saved[] = $this->mediaLibrary->upload($file, 'public', $altName);
        }

        return response()->json([
            'success' => true,
            'items'   => $saved,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'alt_name' => 'nullable|string|max:255'
        ]);

        $media = $this->mediaLibrary->updateMedia($id, $validated);

        return response()->json([
            'success' => true,
            'message' => 'Media updated successfully!',
            'media' => $media
        ]);
    }

    public function ajaxIndex(Request $request): JsonResponse
    {
        $medias = $this->mediaLibrary->paginateList(24, [
            'type'   => $request->get('type'),
            'search' => $request->get('search'),
        ]);

        // Return JSON with proper pagination structure
        return response()->json([
            'data' => $medias->items(),
            'current_page' => $medias->currentPage(),
            'last_page' => $medias->lastPage(),
            'per_page' => $medias->perPage(),
            'total' => $medias->total(),
            'from' => $medias->firstItem(),
            'to' => $medias->lastItem(),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->mediaLibrary->delete($id);

        return response()->json([
            'success' => true,
        ]);
    }
}
