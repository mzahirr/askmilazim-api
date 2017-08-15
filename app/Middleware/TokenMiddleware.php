<?php namespace App\Middleware;

use App\Contract\Repo\UserLoginTokenContract;
use App\Exception\BadRequestException;
use Slim\Http\Request;
use Slim\Http\Response;

class TokenMiddleware
{
    /**
     * @Inject
     * @var UserLoginTokenContract
     */
    private $userLoginTokenRepo;

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     * @throws BadRequestException
     */
    public function __invoke($request, $response, $next)
    {
        /** @var Request $request */

        if (empty($request->getHeader('Auth'))) {
            throw new BadRequestException('Token required');
        }

        if(!$this->userLoginTokenRepo->existByToken($request->getHeader('Auth'))){
            throw new BadRequestException('Token expired');
        }

        /** @var Response $response */
        $response = $next($request, $response);

        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers',
                'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}