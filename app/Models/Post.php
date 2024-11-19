<?php

namespace krnelx\SlimStarter\Models;

use PDO;

class Post
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (:user_id, :title, :content)");
        $stmt->execute([
            ':user_id' => $data['user_id'],
            ':title' => $data['title'],
            ':content' => $data['content']
        ]);

        return $this->pdo->lastInsertId();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($post === false) {
            return null;
        }

        return $post;
    }
}
