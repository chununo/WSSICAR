<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImpuestoStoreRequest;
use App\Http\Requests\ImpuestoUpdateRequest;
use App\Http\Resources\ImpuestoCollection;
use App\Http\Resources\ImpuestoResource;
use App\Models\Impuesto;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImpuestoController extends Controller
{
    public function index(Request $request): ImpuestoCollection
    {
		if ($request->has('store_id')) {
			$impuestos = Impuesto::where('store_id', $request->input('store_id'))->get();
		} else {	
        	$impuestos = Impuesto::all();
		}
        return new ImpuestoCollection($impuestos);
    }

    public function store(ImpuestoStoreRequest $request): ImpuestoResource
    {
        $impuesto = Impuesto::create($request->validated());

        return new ImpuestoResource($impuesto);
    }

    public function show(Request $request, Impuesto $impuesto): ImpuestoResource
    {
        return new ImpuestoResource($impuesto);
    }

    public function update(ImpuestoUpdateRequest $request, Impuesto $impuesto): ImpuestoResource
    {
        $impuesto->update($request->validated());

        return new ImpuestoResource($impuesto);
    }

    public function destroy(Request $request, Impuesto $impuesto): Response
    {
        $impuesto->delete();

        return response()->noContent();
    }
}
