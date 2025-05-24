<?php

namespace App\Http\Controllers;

use App\Http\Requests\CortecajaStoreRequest;
use App\Http\Requests\CortecajaUpdateRequest;
use App\Http\Resources\CortecajaCollection;
use App\Http\Resources\CortecajaResource;
use App\Models\Cortecaja;
use App\Models\Caja;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ServiceResponse;

class CortecajaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Cortecaja::query();

        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }

        $cortes = $query->get();

        return ServiceResponse::success("Lista de cortes de caja ({$cortes->count()})", new CortecajaCollection($cortes));
    }

    public function store(CortecajaStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $storeId = $data['store_id'];
        $cajId = $data['caj_id'];

        $caja = Caja::where('store_id', $storeId)
            ->where('caj_id', $cajId)
            ->first();

        if ($caja) {
            $data['caja_id'] = $caja->id;
            $data['validation_status'] = 'valid';
            $data['validation_errors'] = null;
        } else {
            $data['caja_id'] = null;
            $data['validation_status'] = 'partial';
            $data['validation_errors'] = ['caja_id' => ["La caja {$cajId} no existe en la tienda."]];
        }

        $corte = Cortecaja::create($data);

        return ServiceResponse::success("Corte de caja creado ID {$corte->cor_id} tienda {$corte->store_id}", new CortecajaResource($corte));
    }

    public function show(Request $request, Cortecaja $cortecaja): JsonResponse
    {
        return ServiceResponse::success(
            "Corte de caja ID {$cortecaja->cor_id} tienda {$cortecaja->store_id}",
            new CortecajaResource($cortecaja)
        );
    }

    public function update(CortecajaUpdateRequest $request, Cortecaja $cortecaja): JsonResponse
    {
        $data = $request->validated();
        $storeId = $cortecaja->store_id;
        $cajId = $cortecaja->caj_id;
        $status = 'valid';
        $errors = [];

        $caja = Caja::where('store_id', $storeId)
            ->where('caj_id', $cajId)
            ->first();

        if ($caja) {
            $data['caja_id'] = $caja->id;
        } else {
            $data['caja_id'] = null;
            $status = 'partial';
            $errors['caja_id'] = ["La caja {$cajId} no existe en la tienda."];
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $cortecaja->update($data);

        return ServiceResponse::success("Corte de caja actualizado ID {$cortecaja->cor_id} tienda {$cortecaja->store_id}", new CortecajaResource($cortecaja));
    }

    public function destroy(Request $request, Cortecaja $cortecaja): JsonResponse
    {
        try {
            $recurso = new CortecajaResource($cortecaja);
            $cortecaja->delete();

            return ServiceResponse::success("Corte de caja eliminado ID {$cortecaja->cor_id} tienda {$cortecaja->store_id}", $recurso);
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar el corte de caja.', $th->getTrace(), 500);
        }
    }
}
