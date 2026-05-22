<?php

namespace Core;

class App
{
    protected static $container;

    public static function setContainer($container)
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }

    public static function bind($key, $resolver)
    {
        static::container()->bind($key, $resolver);
    }
    /*
 $db = App:resolve(Database::class) in order for this to work rather than this,
 $db = App::container()->resolve(Database::class);
*/
    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }
}
