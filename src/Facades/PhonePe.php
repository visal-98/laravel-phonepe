<?php

namespace Visal\PhonePe\Facades;

use Illuminate\Support\Facades\Facade;

class PhonePe extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'phonepe';
    }
}
