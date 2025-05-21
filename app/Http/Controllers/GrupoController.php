<?php

namespace App\Http\Controllers;

use App\Http\Requests\GrupoStoreRequest;
use App\Http\Requests\GrupoUpdateRequest;
use App\Http\Resources\GrupoCollection;
use App\Http\Resources\GrupoResource;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helpers\ServiceResponse;

class GrupoController extends Controller
{
    public function index(Request $request): JsonResponse
	{
		if ($request->filled('store_id')) {
			$grupos = Grupo::where('store_id', $request->input('store_id'))->get();
		} else {
			$grupos = Grupo::all(); // solo admins llegarán aquí gracias al middleware
		}

		return ServiceResponse::success("Lista de grupos ({$grupos->count()})", new GrupoCollection($grupos));
	}

    public function store(GrupoStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $grupo = Grupo::create($data);
        return ServiceResponse::success("Grupo creado correctamente.", new GrupoResource($grupo));
    }

    public function show(Request $request, Grupo $grupo): JsonResponse
    {
        return ServiceResponse::success("Grupo obtenido correctamente.", new GrupoResource($grupo));
    }

    public function update(GrupoUpdateRequest $request, Grupo $grupo): JsonResponse
    {
        $grupo->update($request->validated());
        return ServiceResponse::success("Grupo actualizado correctamente.", new GrupoResource($grupo));
    }

    public function destroy(Request $request, Grupo $grupo): JsonResponse
    {
        $registro = new GrupoResource($grupo);
        $grupo->delete();
        return ServiceResponse::success("Grupo eliminado correctamente.", $registro);
    }
}
