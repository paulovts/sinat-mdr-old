<?php
/**
 * Created by PhpStorm.
 * User: websis
 * Date: 05/10/20
 * Time: 18:31
 */

namespace App\Http\Controllers;

use Slim\Views\Twig;
use Slim\Router;

class LoginController
{
    private $view;

    private $router;

    public function __construct(Twig $view, Router $router)
    {
        $this->view = $view;
        $this->router = $router;
    }

    public function login()
    {

        return $this->view->render($this->reponse, 'auth/login.twig', []);
    }

}