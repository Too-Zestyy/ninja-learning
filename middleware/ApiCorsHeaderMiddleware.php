<?php

namespace middleware;

//use Psr\Http\Server\ServerRequestInterface;
//use Psr\Http\Server\MiddlewareInterface;
//use Psr\Http\Server\RequestHandlerInterface;
//
//class ApiCorsHeaderMiddleware implements MiddlewareInterface
//{
//    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): Response
//    {
//        // Optional: Handle the incoming request
//        // ...
//
//        // Invoke the next middleware and get response
//        $response = $handler->handle($request);
//
//        // Optional: Handle the outgoing response
//        // ...
//        $response = $response->withHeader('Access-Control-Allow-Origin', '*');
//
//        return $response;
//    }
//}

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class ApiCorsHeaderMiddleware implements MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        // Optional: Handle the incoming request
        // ...

        // Invoke the next middleware and get response
        $response = $handler->handle($request);

        // Optional: Handle the outgoing response
        // ...
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');

        return $response;
    }
}