<?php

namespace Kernel;

use Twig\Loader\FilesystemLoader;

class LoadTemplate
{
    public static function load(string $file, array $value): string
    {
        $dir = dirname(__DIR__);
        return (new \Twig\Environment(new FilesystemLoader("$dir/templates/"), [
            "cache" => "$dir/cache/",
            "auto_reload" => true
        ]))->render("$file.html", $value);
    }
}
