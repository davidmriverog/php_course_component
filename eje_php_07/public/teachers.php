<?php

require (__DIR__.'/../bootstrap/start.php');

$data = [
    'user_data'=>[
        'name'=>'David Rivero',
        'rol'=>'students'
    ]
];

$driver = new \Styde\SessionArrayDriver($data);
$session = new \Styde\SessionManager($driver);
$auth = new \Styde\Authenticator($session);
$access = new \Styde\AccessHandler($auth);

if(!$access->check('teachers')){
    abort404();
}

view('teachers',compact('access'));