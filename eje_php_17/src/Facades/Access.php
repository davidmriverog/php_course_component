<?php

namespace Styde\Facades;

use Styde\Container;

class Access extends Facade
{
    public static function getAccessor()
    {
        return 'access';
    }
}