<?php

namespace App\Services\Strategies;

use App\DTO\PasswordOptions;
use App\Services\CharacterSetBuilder;

final class AllCharactersStrategy implements PasswordStrategy
{
    public function buildCharacterSet(PasswordOptions $options, CharacterSetBuilder $builder): CharacterSetBuilder
    {
        if ($options->uppercase) $builder->withUppercase();
        if ($options->lowercase) $builder->withLowercase();
        if ($options->numbers)   $builder->withNumbers();
        if ($options->symbols)   $builder->withSymbols();

        return $builder;
    }
}
