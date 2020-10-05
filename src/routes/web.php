<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



$app->route(['GET'], '/', App\Http\Controllers\IndexController::class)->setName('home');

$app->get('', function (Request $request, Response $response, $args) {
    $response->getBody()->write("API - SINAT");
    return $response;
});