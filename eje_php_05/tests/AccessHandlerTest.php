<?php

use Styde\User;
use Styde\AccessHandler;
use Styde\Authenticator;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function test_grant_access()
    {
        
        $access = new AccessHandler($this->getAuthenticatorMock());

        $this->assertTrue(
            $access->check('ADMIN')
        );
    }

    protected function getAuthenticatorMock()
    {
        $user = Mockery::mock(User::class);
        $user->rol = 'ADMIN';

        $auth = Mockery::mock(Authenticator::class);

        $auth->shouldReceive('check')
            ->once()
            ->andReturn(true);

        $auth->shouldReceive('user')
            ->once()
            ->andReturn($user);

        return $auth;
    }
}