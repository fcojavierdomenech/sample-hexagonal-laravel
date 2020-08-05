<?php

namespace App\Http\Controllers;

use App\src\Currency\Application\CreateCurrencyService;
use App\src\Currency\Application\DeleteCurrencyService;
use App\src\Currency\Application\FindCurrencyService;
use App\src\Currency\Domain\Currency;
use App\src\Currency\Domain\CurrencyNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * @var CreateCurrencyService
     */
    private $currencyCreator;

    /**
     * @var FindCurrencyService
     */
    private $currencyFinder;

    /**
     * @var DeleteCurrencyService
     */
    private $currencyDeleter;


    public function __construct(
        CreateCurrencyService $currencyCreator,
        FindCurrencyService $currencyFinder,
        DeleteCurrencyService $currencyDeleter
    ) {
        $this->currencyCreator = $currencyCreator;
        $this->currencyFinder = $currencyFinder;
        $this->currencyDeleter = $currencyDeleter;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCurrency(Request $request)
    {
        $request->validate([
            'currency' => 'required|max:3',
            'country_id' => 'required'
        ]);

        return $this->currencyCreator->__invoke(
            $request->post('currency'),
            $request->post('country_id')
        );
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrency(int $currencyId)
    {
        return $this->currencyFinder->__invoke($currencyId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteCurrency(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $this->currencyDeleter->__invoke($request->post('id'));
        } catch (CurrencyNotFoundException $e) {
            return response('Resource not found', 404);
        }

        return response('Success deleting the currency', 200);
    }
}
