<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
	public static string $customMessage = 'Paquete cargado correctamente.';
	public function with($request): array
	{
		return [
			'success' => true,
			'message' => static::$customMessage,
		];
	}
}
