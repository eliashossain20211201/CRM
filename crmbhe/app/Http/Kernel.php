<?php
protected $routeMiddleware = [
    // other middlewares
    'jwt.auth' => \PhpOpenSourceSaver\JWTAuth\Middleware\Authenticate::class,
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];
