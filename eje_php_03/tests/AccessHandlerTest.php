<?php

use Styde\Authenticator;
use Styde\AccessHandler;
use Styde\SessionManager;
use Styde\SessionFileDriver;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{
    public function test_grant_access()
    {
        $driver = new SessionFileDriver();
        $session = new SessionManager($driver);
        $auth = new Authenticator($session);
        $access = new AccessHandler($auth);

        $this->assertTrue(
            $access->check("ADMIN")
        );
    }
}