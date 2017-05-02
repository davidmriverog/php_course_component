<?php


namespace Styde\Facades;

use Styde\Container;

abstract class Facade
{
    protected static $container;

    public static function getContainer()
    {
        return static::$container;
    }

    public static function getAccessor()
    {
        throw new \Exception("Please define the getAccesor method in your facade");
    }

    public static function getInstance()
    {
        return static::getContainer()->make(
            static::getAccessor()
        );
    }

    public static function setContainer(Container $container)
    {
        static::$container = $container;
    }

    public static function __callStatic($method,$args)
    {
        $object = static::getInstance();

        return call_user_func_array([
            $object,
            $method
        ],$args);
    } 
}