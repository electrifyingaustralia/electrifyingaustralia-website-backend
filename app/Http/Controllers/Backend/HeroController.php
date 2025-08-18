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

    public function index()
    {
        $heros = $this->heroService->getAllHero();
        return view();
    }

    public function create()
    {
        return view();
    }

    public function store(HeroCreateRequest $request)
    {
        $data = $request->validated();
        $this->heroService->createHero($data);
        return redirect();
    }

    public function show($id)
    {
        $hero = $this->heroService->findHero($id);
        return view();
    }

    public function edit($id)
    {
        $team = $this->heroService->findHero($id);
        return view();
    }

    public function update(HeroUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->heroService->updateHero($id, $data);
        return redirect();
    }

    public function destroy($id)
    {
        $this->heroService->deleteHero($id);
        return redirect();
    }
}
