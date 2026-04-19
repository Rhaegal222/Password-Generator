<?php

namespace App\Repositories;

use App\DTO\PasswordOptions;
use App\Models\Password;

final class EloquentPasswordRepository implements PasswordRepositoryInterface
{
    public function save(string $value, PasswordOptions $options): Password
    {
        return Password::create([
            'value'   => $value,
            'length'  => $options->length,
            'options' => [
                'uppercase'  => $options->uppercase,
                'lowercase'  => $options->lowercase,
                'numbers'    => $options->numbers,
                'symbols'    => $options->symbols,
                'easyToSay'  => $options->easyToSay,
                'easyToRead' => $options->easyToRead,
            ],
        ]);
    }
}
