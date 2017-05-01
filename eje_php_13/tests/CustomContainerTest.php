<?php

use Styde\Container;
use Styde\ContainerException;

class CustomContainerTest extends PHPUnit_Framework_TestCase
{

    public function test_container_make_with_arguments()
    {
        $container = new Container;

        $this->assertInstanceOf(
            MailDummy::class,
            $container->make('MailDummy',[
                'url'=>'styde.net',
                'key'=>'secret'
            ])
        );
    }
}

class MailDummy
{
    protected $url;

    protected $key;

    public function __construct($url,$key)
    {
        $this->url = $url;
        $this->key = $key;
    }
}