<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreUserController;

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