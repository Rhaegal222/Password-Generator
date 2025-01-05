<?php

namespace App\Services;

use function Laravel\Prompts\alert;

class PasswordService
{
    public function generate(int $length, bool $includeUppercase, bool $includeLowercase, bool $includeNumbers, bool $includeSymbols): string
    {
        $characters = '';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lower = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';

        if ($includeUppercase) {
            $characters .= $uppercase;
        }
        if ($includeLowercase) {
            $characters .= $lower;
        }
        if ($includeNumbers) {
            $characters .= $numbers;
        }
        if ($includeSymbols) {
            $characters .= $symbols;
        }
        if ($characters === '') {
            return 'Please select at least one character type.';
        }

        alert('Characters: ' . $characters);

        return substr(str_shuffle(str_repeat($characters, $length)), 0, $length);
    }
}
