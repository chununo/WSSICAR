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
use App\Helpers\ServiceResponse;
use Illuminate\Foundation\Bootstrap\HandleExceptions;

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

			if ($e instanceof ValidationException) {
				return ServiceResponse::error(
					'Error de validación.',
					$e->errors(),
					422
				);
			}

			if ($e instanceof AuthenticationException) {
				return ServiceResponse::error(
					'No autenticado.',
					['auth' => ['Debes iniciar sesión.']],
					401
				);
			}

			if ($e instanceof HttpException && $e->getStatusCode() === 403) {
				return ServiceResponse::error(
					'Permiso denegado.',
					['auth' => ['No tienes permisos para esta acción.']],
					403
				);
			}

			if ($e instanceof ModelNotFoundException) {
				return ServiceResponse::error(
					class_basename($e->getModel()) . ' no encontrado.',
					['modelo' => [$e->getMessage()]],
					404
				);
			}

			if ($e instanceof NotFoundHttpException) {
				return ServiceResponse::error(
					'Ruta o recurso no encontrado.',
					['ruta' => [$e->getMessage()]],
					404
				);
			}

			if ($e instanceof QueryException) {
				return ServiceResponse::error(
					'Error de base de datos.',
					['sql' => [$e->getMessage()]],
					500
				);
			}

			if ($e instanceof HandleExceptions) {
				return ServiceResponse::error(
					'Error de base de datos.',
					['sql' => [$e->getMessage()]],
					500
				);
			}
			return ServiceResponse::error("[SERVER::ERROR] {$e->getMessage()}",$e->getTrace()); // genérico: 500
		});

    })->create();
