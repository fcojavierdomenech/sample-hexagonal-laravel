<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\src\Currency\Domain\Currency;
use Faker\Generator as Faker;

$factory->define(Currency::class, function (Faker $faker) {
    return [
        'currency' => $faker->currencyCode,
        'country_id' => $faker->numberBetween(0,100)
    ];
});
