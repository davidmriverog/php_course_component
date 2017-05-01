<?php

require (__DIR__.'/../bootstrap/start.php');

use Styde\Container;

function teacherController(){

    $access = Container::getInstance()->make('access');

    if(!$access->check('teachers')){
        abort404();
    }

    view('teachers',compact('access'));
}

return teacherController();