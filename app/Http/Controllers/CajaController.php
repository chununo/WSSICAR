<?php

namespace App\Http\Controllers;

use App\Http\Requests\CajaStoreRequest;
use App\Http\Requests\CajaUpdateRequest;
use App\Http\Resources\CajaCollection;
use App\Http\Resources\CajaResource;
use App\Models\Caja;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ServiceResponse;

class CajaController extends Controller
{
    public function index(Request $request): JsonResponse
	{
		$query = Caja::query();
		if ($request->has('store_id')) {
			$query->where('store_id', $request->input('store_id'));
		}
		$cajas = $query->get();
		return ServiceResponse::success("Lista de cajas ({$cajas->count()})", new CajaCollection($cajas));
	}

    public function store(CajaStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $caja = Caja::create($data);

        return ServiceResponse::success(
            "Caja agregada ID {$caja->caj_id} tienda {$caja->store_id}",
            new CajaResource($caja)
        );
    }

    public function show(Request $request, Caja $caja): JsonResponse
    {
        return ServiceResponse::success(
            "Caja ID {$caja->caj_id} tienda {$caja->store_id}",
            new CajaResource($caja)
        );
    }

    public function update(CajaUpdateRequest $request, Caja $caja): JsonResponse
    {
        $caja->update($request->validated());

        return ServiceResponse::success(
            "Caja actualizada ID {$caja->caj_id} tienda {$caja->store_id}",
            new CajaResource($caja)
        );
    }

    public function destroy(Request $request, Caja $caja): JsonResponse
    {
        try {
            $resource = new CajaResource($caja);
            $caja->delete();

            return ServiceResponse::success(
                "Caja eliminada ID {$caja->caj_id} tienda {$caja->store_id}",
                $resource
            );
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar la caja.', $th->getTrace(), 500);
        }
    }
}
