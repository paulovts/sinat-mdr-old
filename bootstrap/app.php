<?php

define('INC_ROOT', __DIR__);
use Slim\Factory\AppFactory;
use DI\Container;
require INC_ROOT . '/../vendor/autoload.php';


$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

//$app->setBasePath('/api');

$app->addErrorMiddleware(true, true, true);
$container = $app->getContainer();

require INC_ROOT.'/../routes/web.php';
//require '../../src/routes/auth.php';

try {
    $app->run();
} catch (Exception $e) {
    // We display a error message
    die(json_encode(array("status" => "falhou", "message" => "Página não encontrada.")));
}