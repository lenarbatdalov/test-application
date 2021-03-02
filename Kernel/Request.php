<?php

namespace Kernel;

use Symfony\Component\Yaml\Yaml;

class Request
{
    public static function render(Responce &$responce): string
    {
        $yaml = Yaml::parseFile(__DIR__ . "/route.yaml");
        Debug::put("routes", $yaml);

        if (in_array($responce->getRequestUri()[0], array_keys($yaml))) {
            $request_uri = $responce->getRequestUri()[0];
            $filename = "$request_uri/{$yaml[$request_uri]["template"]}";
            return LoadTemplate::load($filename, $responce->getParams());
        }
        
        return "ERROR PAGE";
    }
}
