<?php

use Styde\AccessHandler;
use Styde\Auth\AuthenticatorInterface;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{
    public function test_grant_access()
    {
        $auth = new Mockery::mock(AuthenticatorInterface::class);

        $access = new AccessHandler($auth);

        $this->assertTrue(
            $access->check('ADMIN')
        );
    }
}