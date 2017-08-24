<?php namespace App\Middleware;

use App\Exception\BadRequestException;
use App\Repo\MemberLoginTokenRepo;
use App\Service\UtilService;
use Slim\Http\Request;
use Slim\Http\Response;

class MemberTokenMiddleware
{
    /**
     * @Inject
     * @var UtilService
     */
    private $util;

    /**
     * @Inject
     * @var MemberLoginTokenRepo
     */
    private $tokenRepo;

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     * @throws BadRequestException
     */
    public function __invoke($request, $response, $next)
    {
        $token = $request->getHeaderLine('X-Token');

        if (empty($token)) {
            throw new BadRequestException('Token required.');
        }

        if ( ! $this->tokenRepo->existByToken($token)) {
            throw new BadRequestException('Token expired.');
        }

        /** @var Response $response */
        $response = $next($request, $response);

        return $this->util->withCors($request, $response);
    }
}