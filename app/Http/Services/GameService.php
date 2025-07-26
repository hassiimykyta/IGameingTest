<?php

namespace App\Http\Services;

use Illuminate\Support\Collection;

class GameService
{
    private Collection $tiers;
    public function __construct()
    {
        $this->tiers = collect(config('game.tiers'));
    }

    private function getRandomNumber(): int
    {
        return random_int(1, 1000);
    }

    private function isWinningNumber(int $number): bool
    {
        return $number % 2 === 0;
    }

    private function calculatePayout($number): float
    {
        $rule = $this->tiers->firstWhere('min', '<=', $number);

        return $number * $rule['percent'];
    }

    public function play(): float
    {
        $number = $this->getRandomNumber();
        $isWinningNumber = $this->isWinningNumber($number);

        if (!$isWinningNumber) {
            return 0;
        }

        return $this->calculatePayout($number);
    }
}
