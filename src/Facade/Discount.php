<?php

namespace Abolfazlrastegar\LaravelDiscount\Facade;

use Illuminate\Support\Facades\Facade;

class Discount extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'discount';
    }
}
