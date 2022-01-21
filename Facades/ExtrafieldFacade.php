<?php

namespace Modules\Extrafield\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Extrafield\Repositories\ExtrafieldRepository;

class ExtrafieldFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ExtrafieldRepository::class;
    }
}
