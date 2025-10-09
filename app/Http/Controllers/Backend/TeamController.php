<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TeamCreateRequest;
use App\Http\Requests\Backend\TeamUpdateRequest;
use App\Services\Team\TeamServiceInterface;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct(protected TeamServiceInterface $teamService) {}

    public function index(Request $request)
    {
        $teams = $this->teamService->getTeamMembers(['*'], 15, [
            'search' => $request->get('search'),
        ]);

        return view('Backend.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('backend.teams.create');
    }

    public function store(TeamCreateRequest $request)
    {
        $data = $request->validated();
        $this->teamService->createTeamMember($data);

        return response()->json([
            'success' => true,
            'message' => 'Team member created successfully!',
            'redirect' => route('admin.teams.all')
        ]);
    }

    public function show($id)
    {
        $team = $this->teamService->findTeamMember($id);
        return view();
    }

    public function edit($id)
    {
        $team = $this->teamService->findTeamMember($id);
        return view('backend.teams.edit', compact('team'));
    }

    public function update(TeamUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->teamService->updateTeamMember($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Team member updated successfully!',
            'redirect' => route('admin.teams.all')
        ]);
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|exists:teams,id',
            'order.*.order' => 'required|integer',
        ]);

        $this->teamService->updateTeamMemberOrder($request->order);

        return response()->json([
            'success' => true,
            'message' => 'Team member order updated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $this->teamService->deleteTeamMember($id);
        return redirect()->route('admin.teams.all')->with('success', 'Team member deleted successfully!');
    }
}
