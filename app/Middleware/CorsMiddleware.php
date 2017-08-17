<?php namespace App\Middleware;

use App\Service\UtilService;
use Slim\Http\Request;
use Slim\Http\Response;

class CorsMiddleware
{
    /**
     * @Inject
     * @var UtilService
     */
    private $util;

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     *
     * @return Response
     *
     */
    public function __invoke($request, $response, $next)
    {
        /** @var \Slim\Http\Response $response */
        $response = $next($request, $response);

        return $this->util->withCors($request, $response);
    }
}