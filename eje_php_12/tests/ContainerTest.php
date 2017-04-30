<?php 

use Styde\Container;
use Styde\ContainerException;

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

	/**
	 * @expectedException \Styde\ContainerException
	 * @expectedExceptionMessage Unable to build [qux] because Class Norf does not exist
	 */
	public function test_exception_container()
	{
		/*
		$this->setExpectedException(
			ContainerException::class,
			'Unable to build [qux] because Class Norf does not exist'
		);*/

		$container = new Container;

		$container->build('qux','Qux');

		$container->make('qux');
	}

	/**
	 * @expectedException \ReflectionException
	 */
	public function test_does_not_class()
	{
		$container = new Container;

		$container->build('norf','Norf');

		$container->make('norf');	
	}
}

class Foo
{
	public function __construct(Bar $bar,Baz $baz)
	{
		// 
	}
}

class Bar
{
	public function __construct(FooBar $barTwo)
	{
		//
	}
}

class FooBar
{
	//
}


class Baz
{
	//
} 

class Qux
{
	public function __construct(Norf $norf)
	{
		//
	}
}