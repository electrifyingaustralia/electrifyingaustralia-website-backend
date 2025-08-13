<?php

namespace App\Services\Team;

interface TeamServiceInterface
{
    public function getTeamMembers(array $columns = ["*"], int $perPage = 15): object;
    public function getAllTeamMembers(): object;
    public function getTeamMembersList(): object;
    public function findTeamMember(int $id): object;
    public function createTeamMember(array $data): object;
    public function updateTeamMember(int $id, array $data): object;
    public function deleteTeamMember(int $id): bool;
}
