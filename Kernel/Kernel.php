<?php

namespace Kernel;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Kernel
{
    private static $instance = null;

    public $app_dir = "";
    private $storage = [];

    private function __construct() {
        $this->app_dir = dirname(__DIR__);

        $this->storage["responce"] = new Responce($_SERVER['REQUEST_URI'] ?? '');

        $this->storage["twig"] = (new Environment(new FilesystemLoader($this->app_dir . "/templates/"), [
            "cache" => $this->app_dir . "/cache/",
            "auto_reload" => true
        ]));
    }

    private function __clone() {}
    private function __wakeup() {}

    public static function init()
    {
        return self::getInstance();
    }

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

    public static function pop(string $key)
    {
        return self::getInstance()->storage[$key];
    }

    public static function debug()
    {
        $storage = self::$instance->storage;
        echo '<pre>';
        print_r($storage);
        echo '</pre>';
    }
}
