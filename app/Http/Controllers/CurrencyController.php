<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

use App\Services\ForexFacade\I_ForexFacade;

class CurrencyController extends Controller
{
    /**
     * Update Currencies resource in storage
     * @param  I_ForexFacade $forexFacade
     * @return boolean
     */
    public function updateCurrencies(I_ForexFacade $forexFacade) : bool
    {
        try {
            return $forexFacade->execute();
        }
        catch(\Exception $e) {
            //log
            return false;
        }
    }
}