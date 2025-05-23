<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\HorarioPromo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PromocionStoreRequest;
use App\Http\Requests\PromocionUpdateRequest;
use App\Http\Resources\PromocionResource;
use App\Http\Resources\PromocionCollection;
use App\Helpers\ServiceResponse;

class PromocionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Promocion::query();

        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }

        $promociones = $query->get();

        return ServiceResponse::success("Lista de promociones ({$promociones->count()})", new PromocionCollection($promociones));
    }

    public function store(PromocionStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $storeId = $data['store_id'];
        $horId = $data['hor_id'] ?? null;

        $status = 'valid';
        $errors = [];

        if ($horId) {
            $horario = HorarioPromo::where('store_id', $storeId)->where('hor_id', $horId)->first();
            if ($horario) {
                $data['horariopromo_id'] = $horario->id;
            } else {
                $status = 'partial';
                $errors['horariopromo_id'] = ["El horario promocional {$horId} no existe en la tienda."];
                $data['horariopromo_id'] = null;
            }
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $promocion = Promocion::create($data);

        return ServiceResponse::success("Promoción creada correctamente.", new PromocionResource($promocion));
    }

    public function show(Request $request, Promocion $promocion): JsonResponse
    {
        return ServiceResponse::success("Detalle de promoción.", new PromocionResource($promocion));
    }

    public function update(PromocionUpdateRequest $request, Promocion $promocion): JsonResponse
    {
        $data = $request->validated();
        $storeId = $promocion->store_id;

        $status = 'valid';
        $errors = [];

        if (isset($data['hor_id'])) {
            $horario = HorarioPromo::where('store_id', $storeId)->where('hor_id', $data['hor_id'])->first();
            if ($horario) {
                $data['horariopromo_id'] = $horario->id;
            } else {
                $status = 'partial';
                $errors['horariopromo_id'] = ["El horario promocional {$data['hor_id']} no existe en la tienda."];
                $data['horariopromo_id'] = null;
            }
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $promocion->update($data);

        return ServiceResponse::success("Promoción actualizada correctamente.", new PromocionResource($promocion));
    }

	public function changeStatus(Request $request, int $pro_id): JsonResponse
{
    $storeId = $request->store_id;

    $promocion = Promocion::where('store_id', $storeId)
        ->where('pro_id', $pro_id)
        ->first();

    if (! $promocion) {
        return ServiceResponse::error("Promoción con ID {$pro_id} no encontrada en tienda {$storeId}.", [], 404);
    }

    // Determinar si es enable o disable desde la URL
    $status = str_contains($request->path(), '/enable') ? 1 : -1;

    $promocion->status = $status;
    $promocion->save();

    $accion = $status === 1 ? 'activada' : 'desactivada';

    return ServiceResponse::success(
        "Promoción ID {$pro_id} {$accion} correctamente.",
        new PromocionResource($promocion)
    );
}


    public function destroy(Request $request, Promocion $promocion): JsonResponse
    {
        $resource = new PromocionResource($promocion);
        $promocion->delete();

        return ServiceResponse::success("Promoción eliminada correctamente.", $resource);
    }
}
