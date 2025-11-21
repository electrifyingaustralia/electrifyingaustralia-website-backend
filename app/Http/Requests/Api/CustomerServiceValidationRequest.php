<?php

namespace App\Http\Requests\Api;

use App\Models\CustomerService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerServiceValidationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
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
                'email'
            ],
            'phone' => [
                'required',
                'string',
                'max:20'
            ],

            'product_type' => [
                'required',
                'string',
                Rule::in(array_values(CustomerService::PRODUCT_TYPES)),
            ],

            'issue_type' => [
                'required',
                'string',
                Rule::in(array_values(CustomerService::ISSUE_TYPES)),
            ],

            'issue_details' => [
                'nullable',
                'string'
            ],

            'attachment' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf,doc,docx|max:10240'
            ],
        ];
    }
}
