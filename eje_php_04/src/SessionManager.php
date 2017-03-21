<?php 

namespace Styde;

use Styde\Driver\DriverInterface;

class SessionManager
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var SessionFileDriver
     */
    protected $driver;


    /**
     * SessionManager construct.
     * 
     * @param DriverInterface $driver
     */
    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
        $this->load();
    }

    protected function load()
    {
        $this->data = $this->driver->load();
    }

    public function get($key)
    {

        return isset($this->data[$key])
            ? $this->data[$key]
            : null;
    }
}
