<?php

namespace App\Services\Team;

use App\Repositories\Team\TeamRepositoryInterface;
use App\Services\Team\TeamServiceInterface;

class TeamService implements TeamServiceInterface
{
    public function __construct(protected TeamRepositoryInterface $teamRepository) {}

    public function getTeamMembers(array $columns = ["*"], int $perPage = 15): object
    {
        return $this->teamRepository->get($columns, $perPage);
    }

    public function getAllTeamMembers(): object
    {
        return $this->teamRepository->all();
    }

    public function getTeamMembersList(): object
    {
        return $this->teamRepository->list();
    }

    public function findTeamMember(int $id): object
    {
        return $this->teamRepository->find($id);
    }

    public function createTeamMember(array $data): object
    {
        return $this->teamRepository->create($data);
    }

    public function updateTeamMember(int $id, array $data): object
    {
        return $this->teamRepository->update($id, $data);
    }

    public function deleteTeamMember(int $id): bool
    {
        return $this->teamRepository->delete($id);
    }
}
