<?php
return [

    'settings.displayErrorDetails' => getenv('APP_DEBUG'),

    \Slim\Http\Request::class  => \DI\get('request'),
    \Slim\Http\Response::class => \DI\get('response'),
    \App\Base\Container::class => \DI\get(\DI\Container::class),

    'errorHandler' => DI\object(\App\Handler\Error::class)
        ->constructor(DI\get('settings.displayErrorDetails')),

];