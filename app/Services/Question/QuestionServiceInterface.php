<?php

namespace App\Services\Question;

interface QuestionServiceInterface
{
    public function get(array $columns = ['*'], int $perPage = 15): object;
    public function createQuestion(array $data): object;
    public function findQuestion(int $id): object;
    public function updateQuestion(int $id, array $data): object;
    public function deleteQuestion(int $id): bool;
}
