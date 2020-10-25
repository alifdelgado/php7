<?php
ini_set('display_errors', 'On');
$container = require __DIR__ . "/app/bootstrap.php";

$dispatcher = FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $router){
    $router->addRoute("GET", "/", ['App\Controllers\HomeController', 'index']);
    $router->addRoute("GET", "/articulos", ['App\Controllers\HomeController', 'articulos']);
    $router->addRoute("GET", "/articulo/{id}", ['App\Controllers\HomeController', 'articulo']);
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch($route[0])
{
    case \FastRoute\Dispatcher::NOT_FOUND:
        echo "404 NOT FOUND";
    break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo "405 NOT ALLOWED";
    break;
    case \FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];
        $container->call($controller, $parameters);
    break;
}