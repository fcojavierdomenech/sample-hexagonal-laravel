<?php

namespace Currency\Infrastructure;

use App\src\Currency\Domain\CurrencyNotFoundException;
use App\src\Currency\Domain\Currency;

use App\src\Currency\Domain\CurrencyRepositoryInterface;



/**
 * Class CurrencyRepositoryEloquent
 */
class CurrencyRepositoryEloquent extends CurrencyRepositoryInterface
{
    protected $model;

    public function __construct(Currency $currency)
    {
        $this->model = $currency;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function delete($currencyId)
    {
        return $this->model->destroy($currencyId);
    }

    public function find($currencyId)
    {
        if (null == $currency = $this->model->find($currencyId)) {
            throw new CurrencyNotFoundException();
        }

        return $currency;
    }
}
