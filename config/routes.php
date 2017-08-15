<?php

use App\Controller\MainController;

$app->group('/api', function () use ($app) {

    //User Modülü
    //$app->get('/login', [MainController::class, 'Index']); // blabla

})->add(\App\Middleware\TokenMiddleware::class);