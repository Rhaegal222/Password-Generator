<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneratePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'length' => 'required|integer|min:6|max:128',
            'includeSymbols' => 'sometimes|boolean',
        ];
    }
}
