<?php

namespace Kernel;

use Symfony\Component\Yaml\Yaml;

class Request
{
    public static function render(): string
    {
        $yaml = Yaml::parseFile(Kernel::init()->app_dir . "/configs/route.yaml");

        if (in_array(Kernel::pop("responce")->getRequestUri()[0], array_keys($yaml))) {
            $request_uri = Kernel::pop("responce")->getRequestUri()[0];
            $filename = "$request_uri/{$yaml[$request_uri]["template"]}";

            return Kernel::pop("twig")->render("$filename.html", Kernel::pop("responce")->getParams());
        }

        return "ERROR PAGE";
    }
}
