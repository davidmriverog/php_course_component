<?php

use Styde\Container;

function view($template,array $vars)
{

    extract($vars);

    $path = __DIR__.'/../views/';

    # almacenamiento de buffer de salida.
    ob_start();

    require($path. $template . '.php');

    $templateContent = ob_get_clean();

    require($path. 'layout.php');
}

function abort404()
{
    $access = Container::getInstance()->access();
    
    http_response_code(404);

    view('page404',compact('access'));

    exit();
}