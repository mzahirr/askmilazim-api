<?php

use App\Controller\Site\GuestController;
use App\Controller\Site\MemberController;
use App\Controller\Site\StateController;

$app->group('/site', function () use ($app) {

    $app->get('/index', [GuestController::class, 'Index']);

    $app->post('/login', [GuestController::class, 'Login']);
    $app->post('/register', [GuestController::class, 'Register']);

    $app->get('/states', [StateController::class, 'States']);

});

$app->group('/site', function () use ($app) {

    $app->get('/deneme', [MemberController::class, 'Index']);

})->add(\App\Middleware\MemberTokenMiddleware::class);