<?php

require (__DIR__.'/../bootstrap/start.php');

function homeController()
{
    // $access = Container::getInstance()->make('access');

    view('index');
}

return homeController();