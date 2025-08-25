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

        // This is correct - it expects 'files' which matches your JS
        foreach ($request->file('files') as $file) {
            $saved[] = $this->mediaLibrary->upload($file);
        }

        return response()->json([
            'success' => true,
            'items'   => $saved,
        ]);
    }

    public function ajaxIndex(Request $request): JsonResponse
    {
        $medias = $this->mediaLibrary->paginateList(24, [
            'type'   => $request->get('type'),
            'search' => $request->get('search'),
        ]);

        return response()->json($medias);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->mediaLibrary->delete($id);

        return response()->json([
            'success' => true,
        ]);
    }
}
