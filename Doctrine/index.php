<?php
session_start();
ini_set('display_errors', 'On');
$container = require __DIR__ . "/app/bootstrap.php";

$dispatcher = FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $router){
    $router->addRoute("POST", "/logout", ['App\Controllers\AuthController', 'logout']);
    $router->addRoute(["GET", "POST"], "/login", ['App\Controllers\AuthController', 'login']);
    $router->addRoute(["GET", "POST"], "/register", ['App\Controllers\AuthController', 'register']);
    
    $router->addRoute("GET", "/", ['App\Controllers\HomeController', 'index']);
    $router->addRoute("GET", "/all", ['App\Controllers\HomeController', 'all']);
    $router->addRoute("GET", "/insert", ['App\Controllers\HomeController', 'insert']);
    $router->addRoute("GET", "/find/{id}", ['App\Controllers\HomeController', 'findById']);
    $router->addRoute("GET", "/update/{id}", ['App\Controllers\HomeController', 'update']);
    $router->addRoute("GET", "/remove/{id}", ['App\Controllers\HomeController', 'remove']);
    $router->addRoute("GET", "/insert-post/{user_id}", ['App\Controllers\HomeController', 'insertPost']);
    $router->addRoute("GET", "/find-by-username/{username}", ['App\Controllers\HomeController', 'findByUsername']);
    $router->addRoute("GET", "/find-user-with-posts/{user_id}", ['App\Controllers\HomeController', 'findUserWithPosts']);
    
    $router->addRoute("GET", "/dashboard", ['App\Controllers\DashboardController', 'index']);
    
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