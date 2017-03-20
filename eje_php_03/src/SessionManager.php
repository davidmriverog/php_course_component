<?php 

namespace Styde;

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
     * @param array   $data   
     */
    public function __construct(SessionFileDriver $driver)
    {
        $this->driver = $driver;
        $this->load();
    }

    protected function load()
    {
        $this->data = $this->load();
    }

    public function get($key)
    {

        return isset($this->data[$key])
            ? $this->data[$key]
            : null;
    }
}
