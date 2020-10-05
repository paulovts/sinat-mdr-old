<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/enviarEmailAlteracao', function (Request $request, Response $response, $args) {
    require '../../src/controles/enviarEmailAlteracao.php';

    $params = (array)$request->getParsedBody();

    $service = new Service();

    $service->send($params['email']);

    return $response;
});

$app->get('/consultarEmail', function (Request $request, Response $response, $args) {
    require_once "../../require/class/Tab_usuarios.class.php";

    $params = $request->getQueryParams();
    $email = $params['email'];

    $tabUsuario = new Tab_usuarios;

    $resultadoEmail = $tabUsuario->consulta_email($email);

    $response->getBody()->write("$resultadoEmail");
    return $response;
});


$app->get('/login', function (Request $request, Response $response, $args) use ($app) {


});

$app->get('/protected', function () {
    echo 'Página protegida';
});