<?php

define("DS", "/");
define("BASE_URL", realpath("../.").DS);

$autoload_paths = array(
  "application/controllers",
  "application/models"
);

foreach($autoload_paths as $path){
  set_include_path(get_include_path() . ":" . BASE_URL . $path);
}

spl_autoload_register(function ($name){
  $filename = decamelize($name) . ".php";
  require "$filename";
});

function decamelize($string) {
    return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
}

$uri = $_SERVER["REQUEST_URI"];
$params = explode("/", urldecode($uri));

$controller_name = ucfirst($params[1]) . "Controller";
$action = $params[0];

$controller = new $controller_name();
$controller->$action();
