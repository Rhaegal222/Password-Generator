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
            'uppercase' => 'sometimes|boolean',
            'lowercase' => 'sometimes|boolean',
            'numbers' => 'sometimes|boolean',
            'symbols' => 'sometimes|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'uppercase' => $this->boolean('uppercase', true),
            'lowercase' => $this->boolean('lowercase', true),
            'numbers' => $this->boolean('numbers', true),
            'symbols' => $this->boolean('symbols', true),
        ]);
    }
}
