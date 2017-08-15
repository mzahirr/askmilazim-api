<?php
return [

    'settings.displayErrorDetails' => getenv('APP_DEBUG'),

    \App\Contract\Repo\UserContract::class => DI\get(\App\Repo\UserRepo::class),
    \App\Contract\Repo\UserLoginTokenContract::class => DI\get(\App\Repo\UserLoginTokenRepo::class),

    \App\Base\Container::class => \DI\get(\DI\Container::class),
    \Slim\Http\Request::class  => \DI\get('request'),

    'errorHandler' => DI\object(\App\Handler\Error::class)
        ->constructor(DI\get('settings.displayErrorDetails')),

];