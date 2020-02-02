<?php

use Aqua\Core\Kernel;

require_once('vendor/autoload.php');

use Aqua\Component\EventDispatcher;

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

Kernel::init()
    ->register($app);
$app->onStop(function (){
    echo "<H2>Application stopped!</H2>";
});
$app->stop();

EventDispatcher::getInstance()->pool();