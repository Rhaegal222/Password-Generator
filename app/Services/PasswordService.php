<?php

namespace App\Services;

use function Laravel\Prompts\alert;

class PasswordService
{
    public function generate(int $length, bool $includeUppercase, bool $includeLowercase, bool $includeNumbers, bool $includeSymbols, bool $easyToSay, bool $easyToRead)
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
        if ($includeNumbers && !$easyToSay) {
            $characters .= $numbers;
        }
        if ($includeSymbols && !$easyToSay) {
            $characters .= $symbols;
        }
        if ($easyToRead || $easyToSay) {
            $characters = str_replace('I', '', $characters);
            $characters = str_replace('l', '', $characters);
            $characters = str_replace('1', '', $characters);
            $characters = str_replace('O', '', $characters);
            $characters = str_replace('0', '', $characters);
        }
        if ($characters === '') {
            return 'Please select at least one character type.';
        }

        return substr(str_shuffle(str_repeat($characters, $length)), 0, $length);
    }
}
