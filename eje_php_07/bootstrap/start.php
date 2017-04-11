<?php

require __DIR__.'/../vendor/autoload.php';


class_alias('Styde\AccessHandler','Access');

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


$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
