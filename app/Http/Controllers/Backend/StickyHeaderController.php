<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\StickyHeader\StickyHeaderServiceInterface;
use Illuminate\Http\Request;

class StickyHeaderController extends Controller
{
    public function __construct(protected StickyHeaderServiceInterface $stickyHeaderService) {}

    public function index()
    {
        $headers = $this->stickyHeaderService->get();
        return view('Backend.sticky-header.index', compact('headers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:sticky_headers,title',
        ]);

        $this->stickyHeaderService->createStickyHeader($request->all());
        return redirect()->route('admin.sticky-header.all')->with('success', 'Sticky header created successfully!');
    }

    public function edit($id)
    {
        $headerToEdit = $this->stickyHeaderService->findStickyHeader($id);
        $headers = $this->stickyHeaderService->get();
        return view('Backend.sticky-header.index', compact('headerToEdit', 'headers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:sticky_headers,title,' . $id
        ]);

        $this->stickyHeaderService->updateStickyHeader($id, $request->all());
        return redirect()->route('admin.sticky-header.all')->with('success', 'Sticky header updated successfully!');
    }

    public function destroy($id)
    {
        $this->stickyHeaderService->deleteStickyHeader($id);
        return redirect()->route('admin.sticky-header.all')->with('success', 'Sticky header deleted successfully.');
    }
}
