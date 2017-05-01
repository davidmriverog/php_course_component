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

	public function make($name, array $arguments=array())
	{
		if(isset($this->shared[$name]))
			return $this->shared[$name];

		if(isset($this->bindings[$name])){
			$resolver = $this->bindings[$name]['resolver'];
		}else{
			$resolver = $name;
		}
		

		if($resolver instanceof Closure){
			$object = $resolver($this);
		}else{
			$object = $this->build($resolver,$arguments);
		}
		

		return $object;
	}

	public function build($name,array $arguments=array())
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

		$dependencies = array();

		foreach ($constructParams as $key => $value) {


			if(isset($arguments[$value->getName()])){
				$dependencies[] = $arguments[$value->getName()];

				continue;
			}

			try {

				$paramClass = $value->getClass();

			} catch (\ReflectionException $e) {
				throw new ContainerException(
					"Unable to build [$name] because ".$e->getMessage(),
					null,
					$e
				);
			}

			if(!is_null($paramClass)){
				$paramClassName = $paramClass->getName();

				// $arguments[] = new $paramClassName;
				$dependencies[] = $this->build($paramClassName,$arguments);
			}else{
				throw new ContainerException(
					"please provide the value of the parameter {$value->getName()}"
				);
			}
			
		}

		return $reflection->newInstanceArgs($dependencies);

	}
}