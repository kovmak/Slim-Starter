<?php

declare(strict_types=1);

use DI\Container;
use DI\Bridge\Slim\Bridge as SlimAppFactory;
use Psr\Container\ContainerInterface;
use Sangarius\SlimBlog\Models\Post;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container();

$settings = require_once __DIR__ . '/../app/settings.php';
$settings($container);

$container->set(PDO::class, function (ContainerInterface $c) {
    $db = $c->get('settings')['db'];
    $pdo = new PDO("{$db['driver']}:host={$db['host']};dbname={$db['database']}", $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
});

$app = SlimAppFactory::create($container);

$middlewares = require_once __DIR__ . '/../app/middlewares.php';
$middlewares($app);

$routes = require_once __DIR__ . '/../app/routes.php';
$routes($app);

$app->run();
