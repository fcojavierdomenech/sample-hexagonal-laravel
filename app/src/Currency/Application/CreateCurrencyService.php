<?php

namespace App\src\Currency\Application;

use App\src\Currency\Domain\Currency;
use App\src\Currency\Domain\CurrencyRepositoryInterface;
use App\src\Currency\Domain\DuplicatedCurrencyException;


/**
 * Class CreateCurrencyService
 * @author Javier Domenech
 */
class CreateCurrencyService
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
    public function __invoke(string $currencyValue, int $countryId)
    {
        $currency = $this->repository->findByCountryId($countryId);
        if (!empty($currency)) {
            throw new DuplicatedCurrencyException();
        }

        $currency = $this->repository->create([
            'currency' => $currencyValue,
            'country_id' => $countryId
            ]);

        return $currency;
    }
}
