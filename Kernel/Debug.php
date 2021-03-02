<?php

namespace Kernel;

class Debug
{
    private static $instance = null;
    private $storage = [];

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function put(string $key, $value)
    {
        self::getInstance()->storage[$key] = $value;
    }

    public static function pre()
    {
        $storage = self::$instance->storage;
        echo '<pre>';
        print_r($storage);
        echo '</pre>';
    }
}