<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

		$exceptions->renderable(function (NotFoundHttpException $e, $request) {
			$previous = $e->getPrevious();
			if ($previous instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
				$modelo = class_basename($previous->getModel());
		
				return response()->json([
					'message' => "No se encontró el recurso solicitado.",
					'errors' => [
						'modelo' => ["{$modelo} no encontrado o no pertenece a tu tienda."],
					],
				], 404);
			}
			return response()->json([
				'message' => 'El recurso solicitado no fue encontrado.',
				'errors' => [
					'modelo' => [class_basename($e->getMessage()) . ' no encontrado.'],
				],
			], 404);
		});
    })->create();
