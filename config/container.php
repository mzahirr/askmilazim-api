<?php
return [

    'settings.displayErrorDetails' => getenv('APP_DEBUG'),

    //Repo contact inject
    \App\Contract\Repo\UserContract::class => DI\get(\App\Repo\UserRepo::class),
    \App\Contract\Repo\UserLoginTokenContract::class => DI\get(\App\Repo\UserLoginTokenRepo::class),
    \App\Contract\Repo\MemberContract::class => DI\get(\App\Repo\MemberRepo::class),
    \App\Contract\Repo\MemberLoginTokenContract::class => DI\get(\App\Repo\MemberLoginTokenRepo::class),

    \App\Base\Container::class => \DI\get(\DI\Container::class),
    \Slim\Http\Request::class  => \DI\get('request'),

    'errorHandler' => DI\object(\App\Handler\Error::class)
        ->constructor(DI\get('settings.displayErrorDetails')),

];