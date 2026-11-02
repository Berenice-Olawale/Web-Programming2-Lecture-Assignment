<?php

namespace Tests\Feature;

use Tests\TestCase;

class PriceCalculatorControllerTest extends TestCase
{
    public function test_get_shows_default_form(): void
    {
        $this->get('/price-calculator')
            ->assertOk()
            ->assertSee('Price calculator form')
            ->assertSee('name="a"', false)
            ->assertSee('name="b"', false)
            ->assertSee('value="vat"', false);
    }

    public function test_post_vat_shows_price_with_vat(): void
    {
        $this->post('/price-calculator', ['a' => 100000, 'b' => 27, 'op' => 'vat'])
            ->assertOk()
            ->assertSee('Price with VAT')
            ->assertSee('127 000 HUF');
    }

    public function test_post_installment_formats_decimal_result(): void
    {
        $this->post('/price-calculator', ['a' => 100000, 'b' => 3, 'op' => 'installment'])
            ->assertOk()
            ->assertSee('33 333,33 HUF');
    }

    public function test_post_installment_zero_months_shows_error(): void
    {
        $this->post('/price-calculator', ['a' => 100000, 'b' => 0, 'op' => 'installment'])
            ->assertOk()
            ->assertSee('The number of months must be at least 1!');
    }

    public function test_post_eur_conversion(): void
    {
        $this->post('/price-calculator', ['a' => 400000, 'b' => 400, 'op' => 'eur'])
            ->assertOk()
            ->assertSee('1 000,00 EUR');
    }

    public function test_post_without_price_fails_validation(): void
    {
        $this->post('/price-calculator', ['b' => 5, 'op' => 'vat'])
            ->assertSessionHasErrors('a');
    }
}