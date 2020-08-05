<?php

namespace Tests\Unit\Currency;

use App\src\Currency\Application\CreateCurrencyService;
use App\src\Currency\Application\FindCurrencyService;
use App\src\Currency\Domain\Currency;
use App\src\Currency\Domain\CurrencyRepositoryInterface;
use App\src\Currency\Domain\DuplicatedCurrencyException;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateCurrencyServiceTest extends TestCase
{
    /**
     * @var FindCurrencyService
     */
    private $service;

    /**
     * @var MockInterface
     */
    private $repoMock;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->repoMock = Mockery::mock(CurrencyRepositoryInterface::class);
        $this->service = new CreateCurrencyService($this->repoMock);
    }

    public function test_repo_create_is_called()
    {
        $currencyCode = 'EUR';
        $countryId = 1;
        $existingCurrency = null;
        $this->repoMock->shouldReceive('findByCountryId')->with($countryId)->andReturn($existingCurrency)->once();
        $this->repoMock->shouldReceive('create')->with(['currency' => $currencyCode, 'country_id' => $countryId])->once();


        $this->service->__invoke($currencyCode, $countryId);
    }

    public function test_throws_exception_when_not_found()
    {
        $currencyCode = 'EUR';
        $countryId = 1;
        $existingCurrency = factory(Currency::class)->make();
        $this->repoMock->shouldReceive('findByCountryId')->with($countryId)->andReturn($existingCurrency)->once();

        $this->expectException(DuplicatedCurrencyException::class);

        $this->service->__invoke($currencyCode, $countryId);
    }
}

