<?php

require (__DIR__.'/../bootstrap/start.php');

function studentsController()
{
    if(!Access::check('students')){
        abort404();
    }

    view('students');
}

return studentsController();