<?php

namespace krnelx\SlimStarter\Services;

use krnelx\SlimStarter\Models\User;

class AuthService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($username, $password)
    {
        return $this->user->create($username, $password);
    }

    public function login($username, $password)
    {
        $user = $this->user->findByUsername($username);
        if ($user && $this->user->verifyPassword($password, $user['password'])) {
            return $user;
        }
        return null;
    }
}
