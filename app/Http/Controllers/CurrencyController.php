<?php

namespace App\Http\Controllers;

use App\src\Currency\Domain\Currency;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
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

        $currency = new Currency([
            'currency' => $request->post('currency'),
            'country_id' => $request->post('country_id')
            ]);

        $currency->save();

        return response('Success creating the currency', 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrency(int $currencyId)
    {
        if (null == $currency = Currency::find($currencyId)) {
            throw new ModelNotFoundException('Currency not found');
        }

        return $currency;
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

        $currencyId = $request->post('id');

        if (null == $currency = Currency::find($currencyId)) {
            throw new CurrencyNotFoundException();
        }

        /** @var Currency $currency */
        $currency->delete();

        return response('Success deleting the currency', 200);
    }
}
