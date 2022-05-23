<?php

namespace Abolfazlrastegar\LaravelDiscount\Facades;

use Illuminate\Support\Facades\Facade;

class Discount extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'discount';
    }
}
