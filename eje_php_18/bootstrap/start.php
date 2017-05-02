<?php

require __DIR__.'/../vendor/autoload.php';


class_alias('Styde\Facades\Access','Access');

use Styde\Application;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = Container::getInstance();

\Styde\Facades\Access::setContainer($container);


$app = new Application($container);

$app->register();

/*
$app->registerSessionManager();
$app->registerAuthenticator();
$app->registerAccessHandler();
*/

