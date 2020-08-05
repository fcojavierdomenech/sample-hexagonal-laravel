<?php

namespace App\src\Currency\Domain;

use Exception;

class CurrencyNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct();
        $this->message = 'Currency not found';
    }
}
