<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
		
        $exceptions->renderable(function (Throwable $e, $request) {
			// Validaciones (422)
			if ($e instanceof ValidationException) {
				return response()->json([
					'data'    => null,
					'success' => false,
					'message' => 'Error de validación.',
					'errors'  => $e->errors(),
				], 422);
			}

			// No autenticado (401)
			if ($e instanceof AuthenticationException) {
				return response()->json([
					'data'    => null,
					'success' => false,
					'message' => 'No autenticado.',
				], 401);
			}

			// Permiso denegado (403)
			if ($e instanceof HttpException && $e->getStatusCode() === 403) {
				return response()->json([
					'data'    => null,
					'success' => false,
					'message' => 'Permiso denegado.',
				], 403);
			}

			// Recurso no encontrado (404)
			if ($e instanceof ModelNotFoundException) {
				return response()->json([
					'data'    => null,
					'success' => false,
					'message' => class_basename($e->getModel()) . ' no encontrado.',
				], 404);
			}

			// Error SQL (duplicados, claves foráneas, etc)
			if ($e instanceof QueryException) {
				return response()->json([
					'data'    => null,
					'success' => false,
					'message' => 'Error de base de datos: ' . $e->getMessage(),
				], 500);
			}

			if ($e instanceof NotFoundHttpException) {
				return response()->json([
					'data'    => null,
					'success' => false,
					'message' => 'Ruta o recurso no encontrado.',
					'error' => $e->getMessage()
				], 404);
			}

			// Si no se reconoció nada anterior: error genérico
			return response()->json([
				'data'    => null,
				'success' => false,
				'message' => 'Error del servidor.',
			], 500);
		});
    })->create();
