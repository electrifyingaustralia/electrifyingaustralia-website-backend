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

    public function index()
    {
        $teams = $this->teamService->getTeamMembers();

        return view('Backend.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('backend.teams.create');
    }

    public function store(TeamCreateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->uploadAvatar($request->file('avatar'));
        }
        $this->teamService->createTeamMember($data);
        return redirect()->route('admin.teams.all')->with('success', 'Team member created successfully!');
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

        if ($request->hasFile('avatar')) {
            //
        }

        $this->teamService->updateTeamMember($id, $data);
        return redirect();
    }

    public function destroy($id)
    {
        $this->teamService->deleteTeamMember($id);
        return redirect();
    }

    protected function uploadAvatar($file): string
    {
        return $file->store('teams', 'public');
    }
}
