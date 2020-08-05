<?php

namespace App\src\Currency\Application;

use App\src\Currency\Domain\CurrencyNotFoundException;
use App\src\Currency\Domain\CurrencyRepositoryInterface;

/**
 * Class FindCurrencyService
 * @author Javier Domenech
 */
class FindCurrencyService
{
    /**
     * @var CurrencyRepositoryInterface
     */
    private $repository;

    public function __construct(CurrencyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Creates a new currency
     *
     * @return void
     */
    public function __invoke(int $currencyId)
    {
        $currency = $this->repository->find($currencyId);
        if (empty($currency)) {
            throw new CurrencyNotFoundException();
        }

        return $currency;
    }
}
