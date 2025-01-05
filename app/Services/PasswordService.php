<?php

namespace App\Services;

class PasswordService
{
    public function generate($length = 12, $includeSymbols = true): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';

        if ($includeSymbols) {
            $characters .= $symbols;
        }

        return substr(str_shuffle(str_repeat($characters, $length)), 0, $length);
    }
}
