<?php

require (__DIR__.'/../bootstrap/start.php');

use Styde\Container;

function studentsController()
{
    $access = Container::getInstance()->make('access');

    if(!$access->check('students')){
        abort404();
    }

    view('students',compact('access'));
}

return studentsController();