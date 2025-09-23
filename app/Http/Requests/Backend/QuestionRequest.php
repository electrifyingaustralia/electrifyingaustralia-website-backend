<?php

namespace App\Http\Requests\Backend;

class QuestionRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'question' => [
                'required',
                'string',
                'max:255'
            ],

            'options' => [
                'required',
                'array',
                'min:1'
            ],

            'options.*.option' => [
                'required',
                'string'
            ],

            'options.*.type' => [
                'required',
                'in:input,radio,checkbox,file,number'
            ],
        ];
    }
}
