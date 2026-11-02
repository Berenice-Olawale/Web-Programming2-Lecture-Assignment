<?php

namespace App\Services;

use InvalidArgumentException;

class PriceCalculator
{
    public function addVat(int $price, int $vatPercent = 27): int
    {
        return (int) round($price * (100 + $vatPercent) / 100);
    }

    public function applyDiscount(int $price, int $discountPercent): int
    {
        if ($discountPercent < 0 || $discountPercent > 100) {
            throw new InvalidArgumentException('The discount must be between 0 and 100 percent!');
        }

        return (int) round($price * (100 - $discountPercent) / 100);
    }

    public function monthlyInstallment(int $price, int $months): float
    {
        if ($months <= 0) {
            throw new InvalidArgumentException('The number of months must be at least 1!');
        }

        return $price / $months;
    }

    public function convertToEur(int $price, float $rate): float
    {
        if ($rate <= 0) {
            throw new InvalidArgumentException('The exchange rate must be greater than zero!');
        }

        return $price / $rate;
    }
}