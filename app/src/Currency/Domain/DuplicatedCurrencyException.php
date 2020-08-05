<?php

namespace App\src\Currency\Domain;

use Exception;

class DuplicatedCurrencyException extends Exception
{
    public function __construct()
    {
        parent::__construct();
        $this->message = 'The currency for the given country already exists';
    }
}
