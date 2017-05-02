<?php

namespace Styde\Providers;

use Styde\AccessHandler;

class AccessHandlerProviders extends Provider
{
    public function register()
    {
        $this->container->singleton('access',function($container){

            return new AccessHandler($container->make('auth'));
        });
    }
}