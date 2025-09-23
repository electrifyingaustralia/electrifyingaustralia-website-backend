<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SolutionCardCreateRequest;
use App\Http\Requests\Backend\SolutionCardUpdateRequest;
use App\Services\SolutionCard\SolutionCardServiceInterface;
use Illuminate\Http\Request;

class SolutionCardController extends Controller
{
    public function __construct(protected SolutionCardServiceInterface $solutionCardService) {}

    public function index()
    {
        $cards = $this->solutionCardService->get();
        return view('Backend.solution-card.index', compact('cards'));
    }

    public function create()
    {
        $cards = $this->solutionCardService->get();
        return view('Backend.solution-card.create', compact('cards'));
    }

    public function store(SolutionCardCreateRequest $request)
    {
        $data = $request->validated();
        $this->solutionCardService->createSolutionCard($data);
        return redirect()->route('admin.solution-card.all')->with('success', 'Solution card created successfully!');
    }

    public function show(int $id)
    {
        $card = $this->solutionCardService->findSolutionCard($id);
        return view('Backend.solution-card.show', compact('card'));
    }

    public function edit($id)
    {
        $cardToEdit = $this->solutionCardService->findSolutionCard($id);
        $cards = $this->solutionCardService->get();
        return view('Backend.solution-card.index', compact('cardToEdit', 'cards'));
    }

    public function update(SolutionCardUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->solutionCardService->updateSolutionCard($id, $data);
        return redirect()->route('admin.solution-card.all')->with('success', 'Solution card updated successfully!');
    }

    public function destroy($id)
    {
        $this->solutionCardService->deleteSolutionCard($id);
        return redirect()->route('admin.solution-card.all')->with('success', 'Solution card deleted successfully');
    }
}
