<?php

namespace krnelx\SlimStarter\Models;

use PDO;

class User
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function create($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, created_at) VALUES (:username, :password, NOW())");
        $stmt->execute(['username' => $username, 'password' => $hashedPassword]);
        return $this->pdo->lastInsertId();
    }

    public function findByUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
