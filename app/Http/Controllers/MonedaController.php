<?php

namespace App\Http\Controllers;

use App\Models\Moneda;
use App\Http\Requests\MonedaStoreRequest;
use App\Http\Requests\MonedaUpdateRequest;
use App\Http\Resources\MonedaResource;
use App\Http\Resources\MonedaCollection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helpers\ServiceResponse;

class MonedaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Moneda::query();

        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }

        $monedas = $query->get();

        return ServiceResponse::success("Lista de monedas ({$monedas->count()})", new MonedaCollection($monedas));
    }

    public function store(MonedaStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $moneda = Moneda::create($data);

        return ServiceResponse::success("Moneda agregada ID {$moneda->mon_id} store {$moneda->store_id}", new MonedaResource($moneda));
    }

    public function show(Request $request, Moneda $moneda): JsonResponse
    {
        return ServiceResponse::success("Moneda ID {$moneda->mon_id} store {$moneda->store_id}", new MonedaResource($moneda));
    }

    public function update(MonedaUpdateRequest $request, Moneda $moneda): JsonResponse
    {
        $moneda->update($request->validated());

        return ServiceResponse::success("Moneda actualizada ID {$moneda->mon_id} store {$moneda->store_id}", new MonedaResource($moneda));
    }

    public function destroy(Request $request, Moneda $moneda): JsonResponse
    {
        try {
            $registro = new MonedaResource($moneda);
            $moneda->delete();

            return ServiceResponse::success("Moneda eliminada ID {$registro->mon_id} store {$registro->store_id}.", $registro);
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar la moneda.', $th->getTrace(), 500);
        }
    }
}
