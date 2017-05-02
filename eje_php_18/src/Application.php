<?php

namespace Styde;

use Styde\SessionArrayDriver;
use Styde\SessionManager;
use Styde\Authenticator;
use Styde\AccessHandler;
use Styde\Container;

class Application
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register()
    {
        $this->registerSessionManager();
        $this->registerAuthenticator();
        $this->registerAccessHandler();
    }

    protected function registerSessionManager()
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

    protected function registerAuthenticator()
    {
        $this->container->singleton('auth',function($container){

            return new Authenticator($container->make('session'));
        });
    }

    protected function registerAccessHandler()
    {
        $this->container->singleton('access',function($container){

            return new AccessHandler($container->make('auth'));
        });
    }
}





