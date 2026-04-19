<?php

namespace App\Repositories;

use App\DTO\PasswordOptions;
use App\Models\Password;

interface PasswordRepositoryInterface
{
    public function save(string $value, PasswordOptions $options): Password;
}
