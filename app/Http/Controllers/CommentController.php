<?php

namespace krnelx\SlimStarter\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use krnelx\SlimStarter\Models\Comment;

class CommentController
{
    public function create(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        Comment::create([
            'user_id' => $_SESSION['user_id'],
            'post_id' => $data['post_id'],
            'content' => $data['content']
        ]);

        return $response->withHeader('Location', "/posts/{$data['post_id']}")->withStatus(302);
    }

    public function update(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $comment = Comment::findOrFail($args['id']);

        if ($comment->user_id != $_SESSION['user_id']) {
            throw new \Exception('Unauthorized');
        }

        $comment->update(['content' => $data['content']]);

        return $response->withHeader('Location', "/posts/{$comment->post_id}")->withStatus(302);
    }

    public function delete(Request $request, Response $response, array $args)
    {
        $comment = Comment::findOrFail($args['id']);

        if ($comment->user_id != $_SESSION['user_id']) {
            throw new \Exception('Unauthorized');
        }

        $comment->delete();

        return $response->withHeader('Location', "/posts/{$comment->post_id}")->withStatus(302);
    }
}
