<?php

use App\Controller\Site\LoginController;
use App\Controller\Site\MemberController;
use App\Controller\Site\ProfessionController;
use App\Controller\Site\ProvinceController;
use App\Controller\Site\StateController;
use App\Controller\Site\UserController;

$app->post('/login', [LoginController::class, 'generateToken']); // blabla
$app->post('/register', [MemberController::class, 'register']);

$app->group('/api', function () use ($app) {

    //User Modülü
    $app->get('/deneme', [UserController::class, 'Index']); // blabla

    //Şehirler

    $app->get('/getcities', [ProvinceController::class, 'Index']);
    $app->get('/getprovince/{cityId}', [StateController::class, 'getByCityId']);
    $app->get('/getprofessions', [ProfessionController::class, 'all']);

});
/*->add(\App\Middleware\TokenMiddleware::class);*/