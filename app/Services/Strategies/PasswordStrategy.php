<?php

namespace App\Services\Strategies;

use App\DTO\PasswordOptions;
use App\Services\CharacterSetBuilder;

interface PasswordStrategy
{
    public function buildCharacterSet(PasswordOptions $options, CharacterSetBuilder $builder): CharacterSetBuilder;
}
