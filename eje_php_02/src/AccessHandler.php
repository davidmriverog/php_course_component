<?php

namespace Styde;

use Styde\Authenticator as Auth;

class AccessHandler
{
    public static function check($rol)
    {
        return Auth::check() && Auth::user()->rol === $rol;
    }
}