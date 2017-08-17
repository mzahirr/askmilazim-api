<?php

use App\Controller\Site\LoginController;
use App\Controller\Site\MemberController;
use App\Controller\Site\UserController;

$app->post('/login', [LoginController::class, 'generateToken']); // blabla
$app->post('/register', [MemberController::class, 'register']);

$app->group('/api', function () use ($app) {

    //User Modülü
    $app->get('/deneme', [UserController::class, 'Index']); // blabla


})->add(\App\Middleware\TokenMiddleware::class);