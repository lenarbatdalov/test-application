<?php

namespace Kernel;

class Responce
{
    private $request_uri = [];
    private $params = [];

    public function __construct(string $request_uri)
    {
        $this->request_uri = $this->getExplodedUri($request_uri);
    }

    public function getRequestUri(): array
    {
        return $this->request_uri;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    private function setParams(string $param_uri): void
    {
        $result = [];
        $params = explode("&", $param_uri);
        foreach ($params as $param) {
            $temp = explode("=", $param);
            $result[$temp[0] ?: 0] = $temp[1] ?: "";
        }
        $this->params = $result;
    }

    private function getExplodedUri(string $request_uri): array
    {
        $result = [];
        $array = explode("/", $request_uri);
        foreach ($array as $value) {
            if (isset($value[0]) && $value[0] == "?") {
                $this->setParams($value);
                break;
            } else if (mb_strpos($value, "?") !== false) {
                $temp = explode("?", $value);
                $result[] = $temp[0];
                $this->setParams($temp[1]);
                break;
            } else if (!empty($value)) {
                $result[] = $value;
            }
        }
        return $result;
    }
}
