<?php

require __DIR__.'/../vendor/autoload.php';


class_alias('Styde\Facades\Access','Access');

use Styde\Container;
use Styde\Application;


$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = Container::getInstance();

\Styde\Facades\Access::setContainer($container);


$app = new Application($container);

$app->registerProviders([
    Styde\Providers\SessionProviders::class,
    Styde\Providers\AuthenticatorProviders::class,
    Styde\Providers\AccessHandlerProviders::class,
]);

//$app->register();