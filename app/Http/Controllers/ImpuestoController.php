<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImpuestoStoreRequest;
use App\Http\Requests\ImpuestoUpdateRequest;
use App\Http\Resources\ImpuestoCollection;
use App\Http\Resources\ImpuestoResource;
use App\Models\Impuesto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ServiceResponse;

class ImpuestoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
		if ($request->has('store_id')) {
			$impuestos = Impuesto::where('store_id', $request->input('store_id'))->get();
		} else {	
        	$impuestos = Impuesto::all();
		}
		return ServiceResponse::success("Lista de impuestos ({$impuestos->count()})", new ImpuestoCollection($impuestos));

    }

    public function store(ImpuestoStoreRequest $request): JsonResponse
    {
        $impuesto = Impuesto::create($request->validated());

		return ServiceResponse::success("Impuesto agregada id {$impuesto->imp_id} store {$impuesto->store_id}",new ImpuestoResource($impuesto));
    }

    public function show(Request $request, Impuesto $impuesto): JsonResponse
    {
        return ServiceResponse::success("Impuesto id {$impuesto->imp_id} store {$impuesto->store_id}",new ImpuestoResource($impuesto));
    }

    public function update(ImpuestoUpdateRequest $request, Impuesto $impuesto): JsonResponse
    {
        $impuesto->update($request->validated());

        return ServiceResponse::success("Impuesto editado id {$impuesto->imp_id} store {$impuesto->store_id}",new ImpuestoResource($impuesto));
    }

    public function destroy(Request $request, Impuesto $impuesto): JsonResponse
    {
		try {
			$registro = new ImpuestoResource($impuesto);
			$impuesto->delete();
			return ServiceResponse::success("Impuesto eliminado id {$registro->cat_id} store {$registro->store_id}.", $registro);
		} catch (\Throwable $th) {
			return ServiceResponse::error('No se encontró impuesto.',$th->getTrace(),404);
		}
    }
}
