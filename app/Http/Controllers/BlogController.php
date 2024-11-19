<?php

namespace krnelx\SlimStarter\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use krnelx\SlimStarter\Models\Post;
use krnelx\SlimStarter\Models\Comment;

class BlogController
{
    protected $postModel;
    protected $commentModel;

    public function __construct(Post $postModel, Comment $commentModel)
    {
        $this->postModel = $postModel;
        $this->commentModel = $commentModel;
    }

    public function index(Request $request, Response $response)
    {
        $posts = $this->postModel->getAll();

        foreach ($posts as &$post) {
            $post['comments'] = $this->commentModel->where('post_id', $post['id']);
        }

        return view($response, 'home.index', ['posts' => $posts]);
    }

    public function create(Request $request, Response $response)
    {
        return view($response, 'posts.create');
    }

    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $postId = $this->postModel->create([
            'user_id' => $_SESSION['user_id'],
            'title' => $data['title'],
            'content' => $data['content']
        ]);

        return $response->withHeader('Location', "/posts/{$postId}")->withStatus(302);
    }

    public function show(Request $request, Response $response, array $args)
    {
        $postId = $args['id'];
        $post = $this->postModel->find($postId);
        $comments = $this->commentModel->where('post_id', $postId)->get();

        if ($post) {
            return $this->view->render($response, 'posts.show', ['post' => $post, 'comments' => $comments]);
        }

        return $response->withStatus(404)->write('Post not found');
    }

    public function edit(Request $request, Response $response, array $args)
    {
        $post = $this->postModel->find($args['id']);
        return view($response, 'posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $this->postModel->update($args['id'], [
            'title' => $data['title'],
            'content' => $data['content']
        ]);

        return $response->withHeader('Location', "/posts/{$args['id']}")->withStatus(302);
    }

    public function destroy(Request $request, Response $response, array $args)
    {
        $this->postModel->delete($args['id']);
        return $response->withHeader('Location', '/')->withStatus(302);
    }
}
