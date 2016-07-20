<?php

define("DS", "/");
define("BASE_URL", realpath("../.").DS);

$autoload_paths = array(
    "application/controllers",
    "application/models",
    "application/views",
    "system"
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

if($params[1] == ""){
    require "../system/index.php";
    exit(0);
}

$controller_name = ucfirst($params[1]) . "Controller";
$action = ($params[2] != "") ? $params[2] : "index";

$controller = new $controller_name();
$controller->execute($action);
