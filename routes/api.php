<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});

Route::post('user/login', [AuthController::class, "login"]);

// Registro de usuario solo puede ser por el rol de Admin
Route::middleware("auth:sanctum","is_admin")->group(function(){
    Route::post('user/register', [AuthController::class, "register"]);       
});