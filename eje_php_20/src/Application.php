<?php

namespace Styde;

use Styde\Container;

class Application
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            
            $provider = new $provider($this->container);
            $provider->register();
        }
    }
}





