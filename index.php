<?php

use Aqua\Core\Kernel;

require_once('vendor/autoload.php');

use Aqua\Component\EventDispatcher;
use Symfony\Component\HttpFoundation\Response;

EventDispatcher::getInstance()->on("app_started", function (){
    echo "<H2>Application started!</H2>";
});

$app = new Aqua\Component\HttpApplication();
$app->onRun(function (){
    EventDispatcher::getInstance()->send('app_started');
});
$app->onStop(function (){
    EventDispatcher::getInstance()->send('app_stopped');
});

$app->onStop(function (){
    $response = new Response("<h1>Application started!</h1>");
    $response->send();
});
Kernel::init()
    ->register($app);

EventDispatcher::getInstance()->pool();