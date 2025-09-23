<?php

namespace App\Http\Requests\Backend;

class QuestionAssignmentRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'questions' => [
                'sometimes',
                'array'
            ],

            'questions.*' => [
                'exists:questions,id'
            ],

            'question_id' => [
                'sometimes',
                'exists:questions,id'
            ],
        ];
    }
}
