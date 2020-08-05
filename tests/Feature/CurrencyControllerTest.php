<?php

namespace Tests\Feature;

use App\src\Currency\Domain\Currency;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_returns_json_with_currency_info()
    {
        $currency = factory(Currency::class)->create();
        $response = $this->get('/api/currency/find/'.$currency->id);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $currency->id,
            'country_id' => $currency->country_id,
            ]);
    }

    public function test_creates_new_currency()
    {
        $currencyCode = 'USD';
        $countryId = 77;

        $response = $this->post('/api/currency/add/', ['currency' => $currencyCode, 'country_id' => $countryId]);

        $response->assertStatus(201);
        $response->assertJson([
            'currency' => $currencyCode,
            'country_id' => $countryId,
        ]);
    }

    public function test_deletes_new_currency()
    {
        $currencyId = 55;

        $response = $this->post('/api/currency/delete/', ['id' => $currencyId]);

        $response->assertStatus(404);

        $currency = factory(Currency::class)->create();

        $response = $this->post('/api/currency/delete/', ['id' => $currency->id]);

        $response->assertStatus(200);
    }
}

