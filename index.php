<?php

use Kernel\Debug;
use Kernel\Responce;
use Kernel\Request;

require_once __DIR__ . "/vendor/autoload.php";

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$responce = new Responce($_SERVER['REQUEST_URI'] ?? '');
Debug::put("responce", $responce);
$str = Request::render($responce);
echo $str;
Debug::pre();
