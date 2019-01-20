<?php

namespace App\Services;


class ConstructServices
{
    protected static $instances = [];

    /**
     * Method initialization.
     * @return static
     */
    public static function init()
    {
        $serviceName = static::class;

        if (!isset(self::$instances[$serviceName])) {
            self::$instances[$serviceName] = new static();
        }

        return self::$instances[$serviceName];
    }

    /**
     * Alias of method init.
     * @return static
     */
    public static function on()
    {
        return static::init();
    }
}