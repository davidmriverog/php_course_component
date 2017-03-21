<?php

namespace Styde;

use Styde\Driver\DriverInterface;

class SessionArrayDriver implements DriverInterface
{
    protected $data;

    public function __construct(array $data=array())
    {
        $this->array = $array;
    }

    public function load()
    {
        $this->data;
    }
}