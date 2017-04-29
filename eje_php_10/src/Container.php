<?php

namespace Styde;

use Closure;
use ReflectionClass;

class Container
{
	protected $bindings = [];

	protected $shared = [];

	public function bind($name,$resolver)
	{
		$this->bindings[$name] = [
			'resolver'=>$resolver		
		];
	}

	public function instance($name,$object)
	{
		$this->shared[$name] = $object;
	}

	public function make($name)
	{
		if(isset($this->shared[$name]))
			return $this->shared[$name];

		$resolver = $this->bindings[$name]['resolver'];

		if($resolver instanceof Closure){
			$object = $resolver($this);
		}else{
			$object = $this->build($resolver);
		}
		

		return $object;
	}

	public function build($name)
	{
		$reflection = new ReflectionClass($name);

		if(!$reflection->isInstantiable()){
			throw new \InvalidArgumentException('$name is not instantiable!');
		}

		$construct = $reflection->getConstructor(); // ReflectionMethod

		if(is_null($construct)){
			return new $name;
		}

		$constructParams = $construct->getParameters(); // List ReflectionParameter Class

		$arguments = array();

		foreach ($constructParams as $key => $value) {
			
			$paramClassName = $value->getClass()->getName();

			// $arguments[] = new $paramClassName;
			$arguments[] = $this->build($paramClassName);
		}

		return $reflection->newInstanceArgs($arguments);

	}
}