<?php

require (__DIR__.'/../bootstrap/start.php');


$data = [
    'user_data'=>[
        'name'=>'David Rivero',
        'rol'=>'teachers'
    ]
];

$driver = new \Styde\SessionArrayDriver($data);
$session = new \Styde\SessionManager($driver);
$auth = new \Styde\Authenticator($session);
$access = new \Styde\AccessHandler($auth);


view('index',compact('access'));