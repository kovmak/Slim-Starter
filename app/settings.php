<?php

use Psr\Container\ContainerInterface;

return function (ContainerInterface $container) {
    $container->set('settings', fn() => [
        "displayErrorDetails" => true,
        "logErrors" => true,
        "logErrorDetails" => true,
        "db" => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slim_blog',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
    ]);

    $container->set(PDO::class, function (ContainerInterface $c) {
        $settings = $c->get('settings')['db'];
        $dsn = "{$settings['driver']}:host={$settings['host']};dbname={$settings['database']};charset={$settings['charset']}";
        return new PDO($dsn, $settings['username'], $settings['password']);
    });

    $container->set(krnelx\SlimStarter\Models\Post::class, function (ContainerInterface $c) {
        return new krnelx\SlimStarter\Models\Post($c->get(PDO::class));
    });

    $container->set(krnelx\SlimStarter\Http\Containers\HomeController::class, function (ContainerInterface $c) {
        return new krnelx\SlimStarter\Http\Containers\HomeController($c->get(krnelx\SlimStarter\Models\Post::class));
    });
};
