<?php

namespace Styde;

use Styde\Driver\DriverInterface;

class SessionArrayDriver implements DriverInterface
{
    protected $data;

    public function __construct(array $data=array())
    {
        $this->data = $data;
    }

    public function load()
    {
        return $this->data;
    }
}