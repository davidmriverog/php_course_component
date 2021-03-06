<?php

namespace Styde;

use Closure;
use ReflectionClass;

class Container
{
    protected $bindings = [];

    protected $shared = [];

    protected static $instance;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new Container;
        }

        return static::$instance;
    }

    public static function setInstance(Container $container)
    {
        static::$container = $container;
    }

    public function bind($name,$resolver,$shared=false)
    {
        $this->bindings[$name] = [
            'resolver'=>$resolver,
            'shared'=>$shared
        ];
    }

    public function instance($name,$object)
    {
        $this->shared[$name] = $object;
    }

    public function singleton($name,$resolver)
    {
        $this->bind($name,$resolver,TRUE);
    }

    public function make($name, array $arguments=array())
    {
        if(isset($this->shared[$name]))
            return $this->shared[$name];

        if(isset($this->bindings[$name])){
            $resolver = $this->bindings[$name]['resolver'];
            $shared = $this->bindings[$name]['shared'];
        }else{
            $resolver = $name;
            $shared = false;
        }
        

        if($resolver instanceof Closure){
            $object = $resolver($this);
        }else{
            $object = $this->build($resolver,$arguments);
        }

        if($shared){
            $this->shared[$name] = $object;
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