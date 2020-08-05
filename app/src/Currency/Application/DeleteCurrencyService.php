<?php

namespace App\src\Currency\Application;

use App\src\Currency\Domain\CurrencyNotFoundException;
use App\src\Currency\Domain\CurrencyRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


/**
 * Class DeleteCurrencyService
 * @author Javier Domenech
 */
class DeleteCurrencyService
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

        $this->repository->delete($currencyId);
    }
}
