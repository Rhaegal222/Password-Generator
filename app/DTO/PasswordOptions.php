<?php

namespace App\DTO;

use App\Http\Requests\GeneratePasswordRequest;

final class PasswordOptions
{
    public function __construct(
        public readonly int  $length,
        public readonly bool $uppercase,
        public readonly bool $lowercase,
        public readonly bool $numbers,
        public readonly bool $symbols,
        public readonly bool $easyToSay,
        public readonly bool $easyToRead,
    ) {}

    public static function fromRequest(GeneratePasswordRequest $request): self
    {
        $data = $request->validated();

        return new self(
            length:     $data['length'],
            uppercase:  $data['uppercase']  ?? false,
            lowercase:  $data['lowercase']  ?? false,
            numbers:    $data['numbers']    ?? false,
            symbols:    $data['symbols']    ?? false,
            easyToSay:  $data['easyToSay']  ?? false,
            easyToRead: $data['easyToRead'] ?? false,
        );
    }
}
