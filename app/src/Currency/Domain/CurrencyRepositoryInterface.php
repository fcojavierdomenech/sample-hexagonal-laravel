<?php

namespace App\src\Currency\Domain;

interface CurrencyRepositoryInterface
{
    public function find(int $currencyId): ?Currency;

    public function findByCountryId(int $countryId): ?Currency;

    public function create(array $data): Currency;

    public function delete(int $currencyId);
}
