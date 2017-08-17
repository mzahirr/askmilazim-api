<?php namespace App\Service;

use Slim\Http\Request;
use Slim\Http\Response;

class UtilService
{
    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function withCors(Request $request, Response $response)
    {
        $origin = $request->getServerParam('HTTP_ORIGIN');

        return $response
            ->withHeader('Access-Control-Allow-Headers',
                'X-Requested-With, X-Token-Id, X-Token-Hash, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Origin', $origin);
    }
}