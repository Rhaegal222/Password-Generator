<?php

namespace App\Services;

use App\DTO\OperationResult;
use App\DTO\PasswordOptions;
use App\Repositories\PasswordRepositoryInterface;
use App\Services\Strategies\AllCharactersStrategy;
use App\Services\Strategies\EasyToReadStrategy;
use App\Services\Strategies\EasyToSayStrategy;
use App\Services\Strategies\PasswordStrategy;

final class PasswordService
{
    public function __construct(
        private readonly PasswordRepositoryInterface $passwordRepository,
    ) {}

    public function generate(PasswordOptions $options): OperationResult
    {
        $strategy = $this->resolveStrategy($options);
        $builder  = $strategy->buildCharacterSet($options, new CharacterSetBuilder());

        if ($builder->isEmpty()) {
            return OperationResult::fail('Please select at least one character type.');
        }

        $password = $this->draw($builder->build(), $options->length);

        $this->passwordRepository->save($password, $options);

        return OperationResult::ok($password);
    }

    private function resolveStrategy(PasswordOptions $options): PasswordStrategy
    {
        if ($options->easyToSay)  return new EasyToSayStrategy();
        if ($options->easyToRead) return new EasyToReadStrategy();
        return new AllCharactersStrategy();
    }

    private function draw(string $characters, int $length): string
    {
        $pool   = str_split($characters);
        $max    = count($pool) - 1;
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $pool[random_int(0, $max)];
        }

        return $result;
    }
}
