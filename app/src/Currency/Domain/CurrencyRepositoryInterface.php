<?php

namespace App\src\Currency\Domain;

interface CurrencyRepositoryInterface
{
    public function find(int $currencyId);

    public function create(array $data);

    public function delete(int $currencyId);
}
