<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Pushall extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pushall';
    }
}
