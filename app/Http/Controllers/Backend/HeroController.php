<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\HeroCreateRequest;
use App\Http\Requests\Backend\HeroUpdateRequest;
use App\Services\Hero\HeroServiceInterface;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function __construct(protected HeroServiceInterface $heroService) {}

    public function index(Request $request)
    {
        $heroes = $this->heroService->get(['*'], 15, [
            'search' => $request->get('search'),
        ]);
        return view('backend.hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('backend.hero.create');
    }

    public function store(HeroCreateRequest $request)
    {
        $data = $request->validated();
        $this->heroService->createHero($data);

        return response()->json([
            'success' => true,
            'message' => 'Hero created successfully!',
            'redirect' => route('admin.hero.all')
        ]);
    }

    public function show($id)
    {
        $hero = $this->heroService->findHero($id);
        return view();
    }

    public function edit($id)
    {
        $hero = $this->heroService->findHero($id);
        return view('backend.hero.edit', compact('hero'));
    }

    public function update(HeroUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->heroService->updateHero($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Hero updated successfully!',
            'redirect' => route('admin.hero.all')
        ]);
    }

    public function destroy($id)
    {
        $this->heroService->deleteHero($id);
        return redirect()->route('admin.hero.all')->with('success', 'Hero deleted successfully!');
    }
}
