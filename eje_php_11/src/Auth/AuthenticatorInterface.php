<?php

namespace Styde\Auth;

interface AuthenticatorInterface
{
    /**
     * @return bool
     */
    public function check();

    /**
     * @return Styde\User
     */
    public function user();
}