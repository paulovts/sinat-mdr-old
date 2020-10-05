<?php
return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_ENV') === "production" ? false : true,
        'determineRouteBeforeAppMiddleware' => true,
        'viewTemplatesDirectory' => INC_ROOT . '/../resources/views',
    ],
    'hash' => function($c) {
        return new \App\Lib\Hash;
    },

    'flash' => function($c) {
        return new \App\Lib\Flash;
    },
    'twig' => function($c) {
        $twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader($c['settings']['viewTemplatesDirectory']));

        // We need to load this again to use our functions with our mailing system.
        $twig->addExtension(new \App\Twig\TwigExtension($c));

        return $twig;
    },

    'view' => function($c) {
        $view = new \Slim\Views\Twig($c['settings']['viewTemplatesDirectory'], [
            'debug' => env('APP_ENV', 'development') === "production" ? false : true
        ]);

        $view->getEnvironment()->addGlobal('auth', [
            'check' => $c->auth->check(),
            'user' => $c->auth->user(),
        ]);

        $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $c['request']->getUri()));
        $view->addExtension(new \Twig\Extension\DebugExtension);
        $view->addExtension(new \App\Twig\TwigExtension($c));

        $view->getEnvironment()->addGlobal('flash', $c['flash']);

        return $view;
    },

    'notFoundHandler' => function($c) {
        return function($request, $response) use ($c) {
            $response = $response->withStatus(404);
            return $c->view->render($response, 'errors/404.twig', [
                'request_uri' => urldecode($_SERVER['REQUEST_URI'])
            ]);
        };
    },

    'notAllowedHandler' => function($c) {
        return function ($request, $response, $methods) use ($c) {
            $response = $response->withStatus(405);
            return $c->view->render($response, 'errors/405.twig', [
                'request_uri' => $_SERVER['REQUEST_URI'],
                'method' => $_SERVER['REQUEST_METHOD'],
                'methods' => implode(', ', $methods)
            ]);
        };
    },

    'errorHandler' => function($c) {
        return function($request, $response, $exception) use ($c) {
            $response = $response->withStatus(500);

            $data = [
                'exception' => null
            ];

            if(env('APP_ENV') === "development") {
                $data['exception'] = $exception->getMessage();
            }

            return $c->view->render($response, 'errors/500.twig', $data);
        };
    },

];
