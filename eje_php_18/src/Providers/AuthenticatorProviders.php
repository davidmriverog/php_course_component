<?php

namespace Styde\Providers;

use Styde\Authenticator;

class AuthenticatorProviders extends Provider
{
    public function register()
    {
        $this->container->singleton('auth',function($container){

            return new Authenticator($container->make('session'));
        });
    }
}