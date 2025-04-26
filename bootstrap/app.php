<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\JsonResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
			'have_store' => \App\Http\Middleware\haveStore::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // 401 – No autenticado
		$exceptions->renderable(function (AuthenticationException $e, $request) {
			return new JsonResponse([
				'message' => 'No autenticado.',
				'errors'  => ['auth' => ['Debes iniciar sesión.']],
			], 401);
		});

		// 403 – Prohibido
		$exceptions->renderable(function (HttpException $e, $request) {
			if ($e->getStatusCode() !== 403) {
				return null; // solo intercepta 403
			}
			return new JsonResponse([
				'message' => $e->getMessage() ?: 'Permiso denegado.',
				'errors'  => ['auth' => [$e->getMessage() ?: 'Forbidden']],
			], 403);
		});
    })->create();
