<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;

class FormValidation extends FormRequest
{ 
    use ApiResponse;

    public function authorize()
    {
        return true;
    } 
}
