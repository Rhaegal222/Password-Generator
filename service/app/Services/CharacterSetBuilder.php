<?php

namespace App\Services;

final class CharacterSetBuilder
{
    private const UPPERCASE  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private const LOWERCASE  = 'abcdefghijklmnopqrstuvwxyz';
    private const NUMBERS    = '0123456789';
    private const SYMBOLS    = '!@#$%^&*()_+-=[]{}|;:,.<>?';
    private const AMBIGUOUS  = ['I', 'l', '1', 'O', '0'];

    private string $characters = '';

    public function withUppercase(): self
    {
        $this->characters .= self::UPPERCASE;
        return $this;
    }

    public function withLowercase(): self
    {
        $this->characters .= self::LOWERCASE;
        return $this;
    }

    public function withNumbers(): self
    {
        $this->characters .= self::NUMBERS;
        return $this;
    }

    public function withSymbols(): self
    {
        $this->characters .= self::SYMBOLS;
        return $this;
    }

    public function withoutAmbiguous(): self
    {
        $this->characters = str_replace(self::AMBIGUOUS, '', $this->characters);
        return $this;
    }

    public function isEmpty(): bool
    {
        return $this->characters === '';
    }

    public function build(): string
    {
        return $this->characters;
    }
}
