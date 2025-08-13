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
        return view();
    }

    public function create()
    {
        return view();
    }

    public function store(TeamCreateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            //
        }
        $this->teamService->createTeamMember($data);
        return redirect();
    }

    public function show($id)
    {
        $team = $this->teamService->findTeamMember($id);
        return view();
    }

    public function edit($id)
    {
        $team = $this->teamService->findTeamMember($id);
        return view();
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
}
