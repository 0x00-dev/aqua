<?php

use App\http\Controller\DefaultController;

return [
    "default" => [
        "action" => "index",
        "controller" => DefaultController::class,
        "pattern" => "/(\d+)",
        "aliases" => ['id' => '(\d+)']
    ],
    "test" => [
        "action" => "index",
        "controller" => DefaultController::class,
        "pattern" => "\/test\/(\d+)",
        "aliases" => [
            'id' => '(\d+)'
        ]
    ],
];