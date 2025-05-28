<?php

namespace App\Http\Controllers;

use App\Models\Vacacion;
use App\Http\Requests\VacacionStoreRequest;
use App\Http\Requests\VacacionUpdateRequest;
use App\Http\Resources\VacacionCollection;
use App\Http\Resources\VacacionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ServiceResponse;
use Illuminate\Support\Facades\Log;

class VacacionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Vacacion::query();

        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }

        $vacaciones = $query->get();

        return ServiceResponse::success("Lista de vacaciones ({$vacaciones->count()})", new VacacionCollection($vacaciones));
    }

    public function store(VacacionStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
		Log::info('Datos de vacación recibidos:', $data);
        $vacacion = Vacacion::create($data);

        return ServiceResponse::success("Vacación ID {$vacacion->vac_id} tienda {$vacacion->store_id} agregada.", new VacacionResource($vacacion));
    }

    public function show(Request $request, Vacacion $vacacion): JsonResponse
    {
        return ServiceResponse::success("Vacación ID {$vacacion->vac_id} tienda {$vacacion->store_id}", new VacacionResource($vacacion));
    }

    public function update(VacacionUpdateRequest $request, Vacacion $vacacion): JsonResponse
    {
        $data = $request->validated();
        $vacacion->update($data);
        $vacacion->refresh();

        return ServiceResponse::success("Vacación ID {$vacacion->vac_id} tienda {$vacacion->store_id} actualizada.", new VacacionResource($vacacion));
    }

    public function destroy(Request $request, Vacacion $vacacion): JsonResponse
    {
        try {
            $resource = new VacacionResource($vacacion);
            $vacacion->delete();

            return ServiceResponse::success("Vacación ID {$vacacion->vac_id} tienda {$vacacion->store_id} eliminada.", $resource);
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar la vacación.', $th->getTrace(), 500);
        }
    }
}
