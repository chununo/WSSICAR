<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumencortecajaStoreRequest;
use App\Http\Requests\ResumencortecajaUpdateRequest;
use App\Http\Resources\ResumencortecajaCollection;
use App\Http\Resources\ResumencortecajaResource;
use App\Models\Resumencortecaja;
use App\Models\Cortecaja;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ServiceResponse;

class ResumencortecajaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Resumencortecaja::query();
        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }

        $items = $query->get();

        return ServiceResponse::success(
            "Lista de resúmenes de corte de caja ({$items->count()})",
            new ResumencortecajaCollection($items)
        );
    }

    public function store(ResumencortecajaStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $storeId = $data['store_id'];
        $status = 'valid';
        $errors = [];

        $corte = null;
        if (isset($data['cor_id'])) {
            $corte = Cortecaja::where('store_id', $storeId)->where('cor_id', $data['cor_id'])->first();
        }

        if ($corte) {
            $data['cortecaja_id'] = $corte->id;
        } else if (!empty($data['cor_id'])) {
            $errors['cor_id'] = ["El corte con ID {$data['cor_id']} no existe en la tienda."];
            $data['cortecaja_id'] = null;
            $status = 'partial';
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $registro = Resumencortecaja::create($data);

        return ServiceResponse::success(
            "Resumen corte de caja ID {$registro->rcc_id} tienda {$registro->store_id}",
            new ResumencortecajaResource($registro)
        );
    }

    public function show(Request $request, Resumencortecaja $resumencortecaja): JsonResponse
    {
        return ServiceResponse::success(
            "Resumen corte de caja ID {$resumencortecaja->rcc_id} tienda {$resumencortecaja->store_id}",
            new ResumencortecajaResource($resumencortecaja)
        );
    }

    public function update(ResumencortecajaUpdateRequest $request, Resumencortecaja $resumencortecaja): JsonResponse
    {
        $data = $request->validated();
        $storeId = $resumencortecaja->store_id;
        $status = 'valid';
        $errors = [];

        if (array_key_exists('cor_id', $data)) {
            $corte = Cortecaja::where('store_id', $storeId)->where('cor_id', $data['cor_id'])->first();
            if ($corte) {
                $data['cortecaja_id'] = $corte->id;
            } else {
                $errors['cor_id'] = ["El corte con ID {$data['cor_id']} no existe en la tienda."];
                $data['cortecaja_id'] = null;
                $status = 'partial';
            }
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $resumencortecaja->update($data);

        return ServiceResponse::success(
            "Resumen corte de caja actualizado ID {$resumencortecaja->rcc_id} tienda {$resumencortecaja->store_id}",
            new ResumencortecajaResource($resumencortecaja)
        );
    }

    public function destroy(Request $request, Resumencortecaja $resumencortecaja): JsonResponse
    {
        try {
            $resource = new ResumencortecajaResource($resumencortecaja);
            $resumencortecaja->delete();

            return ServiceResponse::success(
                "Resumen corte de caja eliminado ID {$resumencortecaja->rcc_id} tienda {$resumencortecaja->store_id}",
                $resource
            );
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar el resumen.', $th->getTrace(), 500);
        }
    }
}
