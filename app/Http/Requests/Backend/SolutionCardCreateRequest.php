<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SolutionCardCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:solution_cards,title'
            ],

            'description' => [
                'required',
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
