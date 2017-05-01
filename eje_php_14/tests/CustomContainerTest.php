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

    public function test_singleton_container_test()
    {
        $container = new Container;

        $container->singleton('foo','Foo');

        $this->assertSame(
            $container->make('foo'),
            $container->make('foo')
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

class Foo2
{
    public function __construct(Bar2 $bar,Baz2 $baz)
    {
        // 
    }
}

class Bar2
{
    public function __construct(FooBar $barTwo)
    {
        //
    }
}

class FooBar2
{
    //
}


class Baz2
{
    //
} 

class Qux2
{
    public function __construct(Norf2 $norf)
    {
        //
    }
}