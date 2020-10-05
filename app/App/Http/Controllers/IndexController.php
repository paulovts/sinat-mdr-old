<?php

namespace App\Http\Controllers;


class IndexController
{
    protected $view;

    public function __construct(\Slim\Views\Twig $view)
    {
        $this->view = $view;
    }

    public function index($request, $response, $args)
    {
        // your code here
        // use $this->view to render the HTML
        return $this->view->render($response, 'index.twig', []);
    }
}
