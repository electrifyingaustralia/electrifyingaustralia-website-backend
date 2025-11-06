<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;

class QuestionRequest extends BaseRequest
{
    public function rules(): array
    {
        // $questionId = $this->route('question') ?? $this->route('id');

        return [
            'question' => [
                'required',
                'string',
                'max:255',
                // Rule::unique('questions')->ignore($questionId),
            ],

            'input_type' => [
                'required',
                'string',
            ],

            'options' => [
                'nullable',
                'array',
            ],

            'is_required' => [
                'boolean',
            ],

            'question_tag' => [
                'nullable',
                'string',
            ],

            'question_group' => [
                'nullable',
                'string',
            ],
        ];
    }
}
