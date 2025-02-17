<?php
protected $routeMiddleware = [
    // other middlewares
    'auth:api' => \Illuminate\Auth\Middleware\Authenticate::class,
    'jwt.auth' => \PhpOpenSourceSaver\JWTAuth\Middleware\Authenticate::class,
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];
