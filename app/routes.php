<?php

use krnelx\SlimStarter\Http\Controllers\AuthController;
use krnelx\SlimStarter\Http\Controllers\BlogController;
use krnelx\SlimStarter\Http\Controllers\CommentController;
use Slim\App;

return function (App $app) {
    $app->group('', function () use ($app) {
        $app->get('/posts/create', [BlogController::class, 'create']);
        $app->post('/posts', [BlogController::class, 'store']);
        $app->get('/posts/{id}/edit', [BlogController::class, 'edit']);
        $app->put('/posts/{id}', [BlogController::class, 'update']);
        $app->delete('/posts/{id}', [BlogController::class, 'destroy']);

        $app->post('/comments', [CommentController::class, 'store']);
        $app->get('/comments/{id}/edit', [CommentController::class, 'edit']);
        $app->put('/comments/{id}', [CommentController::class, 'update']);
        $app->delete('/comments/{id}', [CommentController::class, 'destroy']);
        })->add(function ($request, $response, $next) {
        if (!isset($_SESSION['user_id'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }
        return $next($request, $response);
    });

    $app->get('/', [BlogController::class, 'index']);
    $app->get('/login', [AuthController::class, 'showLoginForm']);
    $app->post('/login', [AuthController::class, 'login']);
    $app->get('/register', [AuthController::class, 'showRegistrationForm']);
    $app->post('/register', [AuthController::class, 'register']);
    $app->get('/posts/{id}', [BlogController::class, 'show']);
    $app->get('/logout', [AuthController::class, 'logout']);
};
