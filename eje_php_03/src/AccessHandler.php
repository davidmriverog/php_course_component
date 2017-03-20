<?php

namespace Styde;

use Styde\Authenticator as Auth;

class AccessHandler
{
    /**
     * @var Authenticator
     */
    protected $auth;

    /**
     * AccessHandler construct.
     * 
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function check($rol)
    {
        return $this->auth->check() && $this->auth->user()->rol === $rol;
    }
}