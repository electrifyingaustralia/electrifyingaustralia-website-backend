<?php

namespace App\Services\Question;

use App\Repositories\Question\QuestionRepositoryInterface;
use App\Services\Question\QuestionServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionService implements QuestionServiceInterface
{
    public function __construct(protected QuestionRepositoryInterface $questionRepository) {}

    public function get(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->questionRepository->get();
    }
    public function createQuestion(array $data): object
    {
        return DB::transaction(function () use ($data) {
            // Create the question
            $question = $this->questionRepository->create([
                'question' => $data['question'],
                'input_type' => $data['input_type'],
                'slug' => Str::slug($data['question']),
                'is_required' => $data['is_required'],
            ]);

            // Add options
            if (isset($data['options'])) {
                foreach ($data['options'] as $optionData) {
                    $question->options()->create([
                        'option' => $optionData['option'],
                    ]);
                }
            }

            return $question;
        });
    }
    public function findQuestion(int $id): object
    {
        return $this->questionRepository->find($id);
    }
    public function updateQuestion(int $id, array $data): object
    {
        return DB::transaction(function () use ($id, $data) {
            // Update the question
            $question = $this->questionRepository->update($id, [
                'question' => $data['question'],
                'input_type' => $data['input_type'],
                'slug' => Str::slug($data['question']),
                'is_required' => $data['is_required'],
            ]);

            // Remove existing options
            $question->options()->delete();

            // Add new options
            if (isset($data['options'])) {
                foreach ($data['options'] as $optionData) {
                    if (!empty(trim($optionData['option']))) {
                        $question->options()->create([
                            'option' => $optionData['option'],
                        ]);
                    }
                }
            }

            return $question;
        });
    }
    public function deleteQuestion(int $id): bool
    {
        return $this->questionRepository->delete($id);
    }
}
