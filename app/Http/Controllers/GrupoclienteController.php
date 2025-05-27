<?php

namespace App\Http\Controllers;

use App\Models\Grupocliente;
use App\Http\Requests\GrupoclienteStoreRequest;
use App\Http\Requests\GrupoclienteUpdateRequest;
use App\Http\Resources\GrupoclienteCollection;
use App\Http\Resources\GrupoclienteResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ServiceResponse;

class GrupoclienteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Grupocliente::query();
        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }
        $grupos = $query->get();

        return ServiceResponse::success("Lista de grupos de clientes ({$grupos->count()})", new GrupoclienteCollection($grupos));
    }

    public function store(GrupoclienteStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $grupo = Grupocliente::create($data);

        return ServiceResponse::success("GrupoCliente ID {$grupo->grc_id} tienda {$grupo->store_id} agregado.", new GrupoclienteResource($grupo));
    }

    public function show(Request $request, Grupocliente $grupocliente): JsonResponse
    {
        return ServiceResponse::success("GrupoCliente ID {$grupocliente->grc_id} tienda {$grupocliente->store_id}", new GrupoclienteResource($grupocliente));
    }

    public function update(GrupoclienteUpdateRequest $request, Grupocliente $grupocliente): JsonResponse
    {
        $grupocliente->update($request->validated());

        return ServiceResponse::success("GrupoCliente ID {$grupocliente->grc_id} tienda {$grupocliente->store_id} actualizado.", new GrupoclienteResource($grupocliente));
    }

    public function destroy(Request $request, Grupocliente $grupocliente): JsonResponse
    {
        try {
            $resource = new GrupoclienteResource($grupocliente);
            $grupocliente->delete();

            return ServiceResponse::success("GrupoCliente ID {$grupocliente->grc_id} tienda {$grupocliente->store_id} eliminado.", $resource);
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar el grupo de cliente.', $th->getTrace(), 500);
        }
    }
}
