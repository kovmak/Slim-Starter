<?php

namespace krnelx\SlimStarter\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use krnelx\SlimStarter\Models\User;
use krnelx\SlimStarter\Services\AuthService;
use PDO;

class AuthController
{
    private $authService;

    public function __construct(PDO $pdo)
    {
        $userModel = new User($pdo);
        $this->authService = new AuthService($userModel);
    }

    public function showLoginForm(Request $request, Response $response)
    {
        return view($response, 'auth.login');
    }

    public function login(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $user = $this->authService->login($data['username'], $data['password']);

        if ($user) {
            $_SESSION['user_id'] = $user->id;
            return $response->withHeader('Location', '/')->withStatus(302);
        } else {
            return view($response, 'auth.login', ['error' => 'Invalid credentials']);
        }
    }

    public function showRegistrationForm(Request $request, Response $response)
    {
        return view($response, 'auth.register');
    }

    public function register(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $this->authService->register($data['username'], $data['password']);
        return $response->withHeader('Location', '/login')->withStatus(302);
    }

    public function logout(Request $request, Response $response)
    {
        session_destroy();
        return $response->withHeader('Location', '/')->withStatus(302);
    }
}
