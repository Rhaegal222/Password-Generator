<?php

namespace App\DTO;

final class OperationResult
{
    private function __construct(
        public readonly bool    $success,
        public readonly ?string $data  = null,
        public readonly ?string $error = null,
    ) {}

    public static function ok(string $data): self
    {
        return new self(success: true, data: $data);
    }

    public static function fail(string $error): self
    {
        return new self(success: false, error: $error);
    }
}
