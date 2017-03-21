<?php

namespace Styde\Stubs;

use Styde\User;

class AuthenticatorStub
{
    public function check()
    {
        return true;
    }

    public function user()
    {
        return new User([
            'rol'=>'ADMIN'
        ]);
    }
}