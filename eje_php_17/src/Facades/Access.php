<?php

namespace Styde\Facades;

use Styde\Container;

class Access
{
    public static function check($roles)
    {
        return Container::getInstance()
            ->make('access')
            ->check($roles);
    }
}