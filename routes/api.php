<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreUserController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ArticuloImpuestoController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ComboController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('user/login', [AuthController::class, "login"]);

// Registro de usuario solo puede ser por el rol de Admin
Route::middleware("auth:sanctum","is_admin")->group(function(){
    Route::post('user/register', [AuthController::class, "register"]);       
});

// Sucursales
Route::middleware(["auth:sanctum","is_admin"])->group(function(){
    Route::apiResource("stores", StoreController::class);
});

// SucursalesUsuarios
Route::middleware(["auth:sanctum","is_admin"])->group(function(){
    Route::get('storesusers/{store_id}/{user_id}', [StoreUserController::class, 'show']);
    Route::delete('storesusers/{store_id}/{user_id}', [StoreUserController::class, 'destroy']);
    Route::post("storesusers", [StoreUserController::class, "store"]);
    Route::get("storesusers", [StoreUserController::class, "index"]);
});

// Autorizado y con tienda
Route::middleware(["auth:sanctum","have_store"])->group(function(){
	Route::apiResource('impuestos', ImpuestoController::class);
	Route::apiResource('departamentos', DepartamentoController::class);
	Route::apiResource('categorias', CategoriaController::class);
	Route::apiResource('unidades', UnidadController::class)->parameter('unidades', 'unidad');
	Route::apiResource('articulos', ArticuloController::class);
	
	Route::put('articulos/{articulo}/impuestos', [ArticuloImpuestoController::class, 'sync']);

	Route::apiResource('paquetes', PaqueteController::class)->only(['store','index']);
	Route::get('paquetes/{paquete}/{articulo}', [PaqueteController::class, 'show']);
	Route::put('paquetes/{paquete}/{articulo}', [PaqueteController::class, 'update']);
	Route::patch('paquetes/{paquete}/{articulo}', [PaqueteController::class, 'update']);
	Route::delete('paquetes/{paquete}/{articulo}', [PaqueteController::class, 'destroy']);
	
	Route::apiResource('grupos', GrupoController::class);

	Route::apiResource('combos', ComboController::class)->except(['show', 'update', 'destroy']);
	Route::get('combos/{combo}/{grupo}', [ComboController::class, 'show']);
    Route::put('combos/{combo}/{grupo}', [ComboController::class, 'update']);
    Route::patch('combos/{combo}/{grupo}', [ComboController::class, 'update']);
    Route::delete('combos/{combo}/{grupo}', [ComboController::class, 'destroy']);
});



