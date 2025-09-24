<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SolutionCardUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $cardId = $this->route('solution-card') ?? $this->route('id');
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('solution_cards', 'title')->ignore($cardId),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'bold_info' => [
                'nullable',
                'max:255',
            ],

            'extra_info' => [
                'nullable',
                'max:255',
            ],
        ];
    }
}
