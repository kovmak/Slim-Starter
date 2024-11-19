<?php

use Jenssegers\Blade\Blade;
use Psr\Http\Message\ResponseInterface as Response;

if (!function_exists('view')) {
    function view(Response $response, string $template, array $with = []): Response
    {
        $cache = __DIR__ . '/../cache';
        $views = __DIR__ . '/../resources/views';

        $blade = new Blade($views, $cache);
        $view = $blade->make($template, $with);
        $response->getBody()->write($view->render());

        return $response;
    }
}
