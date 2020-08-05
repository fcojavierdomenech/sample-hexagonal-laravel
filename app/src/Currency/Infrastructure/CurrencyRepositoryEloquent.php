<?php

namespace App\src\Currency\Infrastructure;

use App\src\Currency\Domain\CurrencyNotFoundException;
use App\src\Currency\Domain\Currency;

use App\src\Currency\Domain\CurrencyRepositoryInterface;



/**
 * Class CurrencyRepositoryEloquent
 */
class CurrencyRepositoryEloquent implements CurrencyRepositoryInterface
{
    protected $model;

    public function __construct(Currency $currency)
    {
        $this->model = $currency;
    }

    public function create(array $data): Currency
    {
        return $this->model->create($data);
    }

    public function delete(int $currencyId)
    {
        return $this->model->destroy($currencyId);
    }

    public function find(int $currencyId): ?Currency
    {
        return $this->model->find($currencyId);
    }

    public function findByCountryId(int $countryId): ?Currency
    {
        $currency = $this->model->where('country_id', $countryId)->first();

        return $currency;
    }
}
