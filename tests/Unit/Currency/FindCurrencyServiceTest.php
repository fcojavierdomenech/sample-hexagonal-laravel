<?php

namespace Tests\Unit\Currency;

use App\src\Currency\Application\FindCurrencyService;
use App\src\Currency\Domain\Currency;
use App\src\Currency\Domain\CurrencyNotFoundException;
use App\src\Currency\Domain\CurrencyRepositoryInterface;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class FindCurrencyServiceTest extends TestCase
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
        $this->service = new FindCurrencyService($this->repoMock);
    }

    public function test_repo_find_is_called()
    {
        $id = 1;
        $currency = factory(Currency::class)->make();
        $this->repoMock->shouldReceive('find')->with($id)->andReturn($currency)->once();

        $this->service->__invoke($id);
    }

    public function test_throws_exception_when_not_found()
    {
        $id = 1;
        $this->repoMock->shouldReceive('find')->with($id)->andReturn(null)->once();

        $this->expectException(CurrencyNotFoundException::class);

        $this->service->__invoke($id);
    }
}
