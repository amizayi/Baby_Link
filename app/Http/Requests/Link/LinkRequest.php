<?php

namespace App\Http\Requests\Link;

use App\Http\Requests\FormValidation;
use Illuminate\Contracts\Validation\Validator;

class LinkRequest extends FormValidation
{
    public function rules()
    {
        return [
            'code' => 'nullable|unique:links,code',
            'redirect_url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'The code has already exists.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return $this->validationResponse($validator->errors());
    }
}
