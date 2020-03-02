<?php

use Aqua\Component\Router;
use Aqua\Core\Kernel;

require_once('vendor/autoload.php');

$app = new Aqua\Component\HttpApplication();

$app->onRun(function (){
    $app = Kernel::init()->getApp("http");
    $router = new Router($app);
    $router->run($_SERVER['REQUEST_URI']);
    $route = $router->getRoute();
    $controller = $route->getController();
    $action = $route->getAction();
    $placeholders = $route->getPlaceholders();

    (new $controller($app))->{$action}($placeholders);
});

Kernel::init()
    ->register($app);