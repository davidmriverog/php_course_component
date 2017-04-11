<?php

require (__DIR__.'/../bootstrap/start.php');


if(!$access->check('students')){
    abort404();
}


view('students',compact('access'));