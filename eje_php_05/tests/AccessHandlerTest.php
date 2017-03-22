<?php

use Styde\Authenticator;
use Styde\AccessHandler;
use Styde\SessionManager;
use Styde\SessionFileDriver;
use Styde\SessionArrayDriver;
use Styde\Stubs\AuthenticatorStub;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{
    public function test_grant_access()
    {
        $auth = new AuthenticatorStub();

        $access = new AccessHandler($auth);

        $this->assertTrue(
            $access->check('ADMIN')
        );
    }
}