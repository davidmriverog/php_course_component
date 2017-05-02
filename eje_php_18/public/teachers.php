<?php

require (__DIR__.'/../bootstrap/start.php');

function teacherController(){

    if(!Access::check('teachers')){
        abort404();
    }

    view('teachers');
}

return teacherController();