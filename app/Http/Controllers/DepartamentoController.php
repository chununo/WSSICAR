<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentoStoreRequest;
use App\Http\Requests\DepartamentoUpdateRequest;
use App\Http\Resources\DepartamentoCollection;
use App\Http\Resources\DepartamentoResource;
use App\Models\Departamento;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ServiceResponse;

class DepartamentoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if ($request->has('store_id')) {
			$departamentos = Departamento::where('store_id', $request->input('store_id'))->get();
		} else {
			$departamentos = Departamento::all();
		}
		
        return ServiceResponse::success("Lista de departamentos ({$departamentos->count()})", new DepartamentoCollection($departamentos));
    }

    public function store(DepartamentoStoreRequest $request): JsonResponse
    {
        $departamento = Departamento::create($request->validated());

        return ServiceResponse::success("Departamento agregado id {$departamento->dep_id} store {$departamento->store_id}", $departamento);
    }

    public function show(Request $request, Departamento $departamento): JsonResponse
    {
        return ServiceResponse::success("Departamento id {$departamento->dep_id} store {$departamento->store_id}", new DepartamentoResource($departamento));
    }

    public function update(DepartamentoUpdateRequest $request, Departamento $departamento): JsonResponse
    {

        $departamento->update($request->validated());

        return ServiceResponse::success("Departamento actualizado id {$departamento->dep_id} store {$departamento->store_id}", new DepartamentoResource($departamento));
    }

    public function destroy(Request $request, Departamento $departamento): JsonResponse
    {
		try {
			$registro = new DepartamentoResource($departamento);
			$departamento->delete();
			return ServiceResponse::success("Departamento eliminado id {$registro->dep_id} store {$registro->store_id}", $registro);
			
		} catch (\Throwable $th) {
			return ServiceResponse::error("No se encontro departamento", $th->getTrace(),404);
		}
    }
}
