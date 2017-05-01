<?php


class SingletonTest extends PHPUnit_Framework_TestCase
{

    public function test_singleton_instance()
    {
        $this->assertInstanceOf(
            GreeterDummny::class,
            GreeterDummny::getInstance()
        );
    }

    public function test_singleton_creates_only_one_instance()
    {
        $this->assertSame(
            GreeterDummny::getInstance(),
            GreeterDummny::getInstance()
        );
    }

    public function test_welcome_known_users()
    {
        $greeter = new GreeterDummny('David');

        $this->assertSame(
            'Bienvenido a nuestro portal David',
            $greeter->welcome()
        );
    }
}

class GreeterDummny
{
    private static $instance;

    protected $name = 'Invitado(a)';

    public function __construct($name = null)
    {
        if(!is_null($name))
            $this->name = $name;
    }

    public static function getInstance($name = null)
    {
        if(is_null(static::$instance)){
            static::$instance = new GreeterDummny($name);
        }

        return static::$instance;
    }

    public function welcome()
    {
        return "Bienvenido a nuestro portal {$this->name}";
    }
}