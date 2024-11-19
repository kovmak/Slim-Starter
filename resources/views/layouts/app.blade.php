<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Blog on Slim')</title>
    <link rel="stylesheet" href="{{ '/css/style.css' }}">
</head>
<body>
<header class="header">
    @yield('header')
</header>
<main class="main">
    @yield('content')
</main>
<footer class="footer">
    Blog on SLIM
</footer>
</body>
</html>
