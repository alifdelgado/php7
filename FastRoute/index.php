<?php

// header("Content-Type: text/plain");
require "vendor/autoload.php";

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route){
    $route->addRoute("GET", "/usuarios", "getAllUsers");
    $route->addRoute("GET", "/usuario/{id:\d+}", "getUser");
    $route->addRoute("GET", "/posts/{title}", "getPostByTitle");
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch($routeInfo[0])
{
    case \FastRoute\Dispatcher::NOT_FOUND:
        echo "Ruta no encontrada";
    break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo "Ruta no permitida";
    break;
    case \FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $params = $routeInfo[2];
        call_user_func($handler, $params);
    break;
}

function getAllUsers(array $params)
{
    echo "Obtener todos los usuarios" . PHP_EOL;
    var_dump($params);
}

function getUser(array $params)
{
    echo "Obteniendo al usuario con el ID: {$params['id']}" . PHP_EOL;
}

function getPostByTitle(array $params)
{
    echo "El titulo del post es: {$params['title']}" . PHP_EOL;
}