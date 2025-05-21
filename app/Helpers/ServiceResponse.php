<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResponse
{
	public static function success(string $message = "Operación exitosa.", mixed $data = null, int $code = 200) : JsonResponse
	{
		return response()->json([
			'success' 	=> true,
			'message' 	=> $message,
			'data'		=> $data instanceof JsonResource ? $data->resolve() : $data
		],$code);
	}
	public static function error(string $message = 'Error del servidor.',array $errors = [],int $code = 500): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors'  => $errors ?: null,
            'data'    => null,
        ], $code);
    }
}
