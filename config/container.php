<?php
return [

    'settings.displayErrorDetails' => getenv('APP_DEBUG'),

    //Repo contact inject
    \App\Contract\Repo\UserContract::class => DI\get(\App\Repo\UserRepo::class),
    \App\Contract\Repo\UserLoginTokenContract::class => DI\get(\App\Repo\UserLoginTokenRepo::class),
    \App\Contract\Repo\MemberContract::class => DI\get(\App\Repo\MemberRepo::class),
    \App\Contract\Repo\MemberLoginTokenContract::class => DI\get(\App\Repo\MemberLoginTokenRepo::class),
    \App\Contract\Repo\ProvinceContract::class => DI\get(\App\Repo\ProvinceRepo::class),
    \App\Contract\Repo\StateContract::class => DI\get(\App\Repo\StateRepo::class),
    \App\Contract\Repo\ProfessionContract::class => DI\get(\App\Repo\ProfessionRepo::class),

    \Slim\Http\Request::class => \DI\get('request'),
    \Slim\Http\Response::class => \DI\get('response'),
    \App\Base\Container::class => \DI\get(\DI\Container::class),

    'errorHandler' => DI\object(\App\Handler\Error::class)
        ->constructor(DI\get('settings.displayErrorDetails')),

];