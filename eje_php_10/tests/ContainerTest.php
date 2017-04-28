<?php 

use Styde\Container;

class ContainerTest extends PHPUnit_Framework_TestCase
{

	public function test_bind_from_clousure()
	{
		$container = new Container();

		$container->bind('key',function(){
			return 'Object';
		});

		$this->assertSame('Object',$container->make('key'));
	}

	public function test_bind_instance()
	{
		$container = new Container();

		$stdClass = new stdClass();

		$container->instance('key',$stdClass);

		$this->assertSame($stdClass,$container->make('key'));
	}

	public function test_class_from_class_name()
	{
		$container = new Container();

		$container->bind('key','stdClass');

		$this->assertInstanceOf('stdClass',$container->make('key'));
	}

	public function test_bind_with_automatic_resolution()
	{
		$container = new Container();

		$container->bind('foo','Foo');

		$this->assertInstanceOf('Foo',$container->make('foo'));
	}
}

class Foo
{
	public function __construct(Bar $bar)
	{
		// 
	}
}

class Bar
{
	//
}