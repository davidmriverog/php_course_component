<?php

namespace Styde;

class AccessHandler
{
    public static function check($rol)
    {
        return 'ADMIN' === $rol;
    }
}