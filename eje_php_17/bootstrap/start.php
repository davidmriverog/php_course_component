<?php

require __DIR__.'/../vendor/autoload.php';


class_alias('Styde\Facades\Access','Access');


$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

use Styde\SessionArrayDriver;
use Styde\SessionManager;
use Styde\Authenticator;
use Styde\AccessHandler;
use Styde\Container;

$container = Container::getInstance();

\Styde\Facades\Access::setContainer($container);

$container->singleton('session',function(){

    $data = [
        'user_data'=>[
            'name'=>'David Rivero',
            'rol'=>'students'
        ]
    ];

    $driver = new SessionArrayDriver($data); 

    return new SessionManager($driver);
});

$container->singleton('auth',function($container){

    return new Authenticator($container->make('session'));
});

$container->singleton('access',function($container){

    return new AccessHandler($container->make('auth'));
});
