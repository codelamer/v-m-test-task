<?php

namespace test;

class Loader
{
    protected static $_libdir = 'lib';

    public static function init()
    {
        return spl_autoload_register(array(__CLASS__, 'includeClass'));
    }

    public static function includeClass($class)
    {
        $filename = PROJECTROOT . '/' . self::$_libdir . '/' . strtr($class, '_\\', '//') . '.php';
        // проверяем наличие файла, который необходимо использовать
        if (file_exists($filename))
        {
            require_once($filename);
        }
    }
}

function S($class)
{
    $class = __NAMESPACE__ . '\\' . $class;
    return $class::getInstance();
}
