<?php

namespace Tests\Unit;

use App\Services\PriceCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    private PriceCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new PriceCalculator();
    }

    public function test_vat_default_rate_is_27_percent(): void
    {
        $this->assertSame(127000, $this->calculator->addVat(100000));
    }

    public function test_vat_custom_rate(): void
    {
        $this->assertSame(210000, $this->calculator->addVat(200000, 5));
    }

    public function test_discount_ten_percent(): void
    {
        $this->assertSame(180000, $this->calculator->applyDiscount(200000, 10));
    }

    public function test_discount_zero_percent_keeps_price(): void
    {
        $this->assertSame(150000, $this->calculator->applyDiscount(150000, 0));
    }

    public function test_discount_hundred_percent_is_free(): void
    {
        $this->assertSame(0, $this->calculator->applyDiscount(150000, 100));
    }

    public function test_discount_above_hundred_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The discount must be between 0 and 100 percent!');
        $this->calculator->applyDiscount(100000, 101);
    }

    public function test_installment_even_split(): void
    {
        $this->assertEqualsWithDelta(10000.0, $this->calculator->monthlyInstallment(120000, 12), 0.0001);
    }

    public function test_installment_with_remainder(): void
    {
        $this->assertEqualsWithDelta(100000 / 3, $this->calculator->monthlyInstallment(100000, 3), 0.0001);
    }

    public function test_installment_zero_months_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The number of months must be at least 1!');
        $this->calculator->monthlyInstallment(100000, 0);
    }

    public function test_eur_conversion(): void
    {
        $this->assertEqualsWithDelta(1000.0, $this->calculator->convertToEur(400000, 400.0), 0.0001);
    }

    public function test_eur_zero_rate_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The exchange rate must be greater than zero!');
        $this->calculator->convertToEur(400000, 0);
    }
}