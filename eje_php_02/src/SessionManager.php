<?php 

namespace Styde;

class SessionManager
{
    protected static $data = array();

    protected static $loaded = false;

    public static function load()
    {
        if (static::$loaded) return;

        static::$data = SessionFileDriver::load();
        
        static::$loaded = true;
    }

    public static function get($key)
    {
        return isset(static::$data[$key])
            ? static::$data[$key]
            : null;
    }
}
