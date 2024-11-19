<?php

namespace krnelx\SlimStarter\Models;

use PDO;

class Comment
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($userId, $postId, $content)
    {
        $stmt = $this->pdo->prepare("INSERT INTO comments (user_id, post_id, content, created_at) VALUES (:user_id, :post_id, :content, NOW())");
        $stmt->execute(['user_id' => $userId, 'post_id' => $postId, 'content' => $content]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $content)
    {
        $stmt = $this->pdo->prepare("UPDATE comments SET content = :content WHERE id = :id");
        return $stmt->execute(['content' => $content, 'id' => $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function where($column, $value)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE $column = :value");
        $stmt->execute([':value' => $value]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
