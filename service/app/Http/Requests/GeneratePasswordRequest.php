<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneratePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'length'       => 'required|integer|min:6|max:128',
            'uppercase'    => 'sometimes|boolean',
            'lowercase'    => 'sometimes|boolean',
            'numbers'      => 'sometimes|boolean',
            'symbols'      => 'sometimes|boolean',
            'easyToSay'    => 'sometimes|boolean',
            'easyToRead'   => 'sometimes|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'uppercase'  => $this->boolean('uppercase',  false),
            'lowercase'  => $this->boolean('lowercase',  false),
            'numbers'    => $this->boolean('numbers',    false),
            'symbols'    => $this->boolean('symbols',    false),
            'easyToSay'  => $this->boolean('easyToSay',  false),
            'easyToRead' => $this->boolean('easyToRead', false),
        ]);
    }
}
