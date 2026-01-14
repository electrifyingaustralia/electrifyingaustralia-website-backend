<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class QuotationValidationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->filled('package_id')) {
            return [
                'package_id' => [
                    'required',
                    'integer',
                    'exists:packages,id'
                ],

                'first_name' => [
                    'required',
                    'string',
                    'max:255'
                ],

                'last_name' => [
                    'required',
                    'string',
                    'max:255'
                ],

                'email' => [
                    'required',
                    'email',
                    'max:255'
                ],

                'phone' => [
                    'required',
                    'string',
                    'max:255'
                ],

                'message' => [
                    'nullable',
                    'string'
                ],
            ];
        }
        $action = $this->input('action');
        if ($action === 'contact') {
            return [
                'first_name' => [
                    'required',
                    'string',
                    'max:255'
                ],

                'last_name' => [
                    'required',
                    'string',
                    'max:255'
                ],

                'email' => [
                    'required',
                    'email',
                    'max:255'
                ],

                'phone' => [
                    'required',
                    'string',
                    'max:255'
                ],

                'message' => [
                    'nullable',
                    'string'
                ],
            ];
        }

        return [
            'email' => [
                'required',
                'email',
                'max:255'
            ],
        ];
    }
}
