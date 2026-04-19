<?php

namespace App\Services\Strategies;

use App\DTO\PasswordOptions;
use App\Services\CharacterSetBuilder;

final class EasyToSayStrategy implements PasswordStrategy
{
    public function buildCharacterSet(PasswordOptions $options, CharacterSetBuilder $builder): CharacterSetBuilder
    {
        if ($options->uppercase) $builder->withUppercase();
        if ($options->lowercase) $builder->withLowercase();

        return $builder->withoutAmbiguous();
    }
}
