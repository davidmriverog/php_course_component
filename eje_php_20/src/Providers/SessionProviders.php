<?php

namespace Styde\Providers;

use Styde\SessionArrayDriver;
use Styde\SessionManager;

class SessionProviders extends Provider
{

    public function register()
    {
        $this->container->singleton('session',function(){

            $data = [
                'user_data'=>[
                    'name'=>'David Rivero',
                    'rol'=>'students'
                ]
            ];

            $driver = new SessionArrayDriver($data); 

            return new SessionManager($driver);
        });
    }
}