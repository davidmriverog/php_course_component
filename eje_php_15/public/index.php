<?php

require (__DIR__.'/../bootstrap/start.php');

use Styde\Container;

function homeController()
{
    $access = Container::getInstance()->make('access');

    view('index',compact('access'));
}

return homeController();