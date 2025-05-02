<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadStoreRequest;
use App\Http\Requests\UnidadUpdateRequest;
use App\Http\Resources\UnidadCollection;
use App\Http\Resources\UnidadResource;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UnidadController extends Controller
{
    public function index(Request $request): UnidadCollection
    {
		if ($request->has('store_id')) {
			$unidads = Unidad::where('store_id', $request->input('store_id'))->get();
		} else {
			$unidads = Unidad::all();
		}       

        return new UnidadCollection($unidads);
    }

    public function store(UnidadStoreRequest $request): UnidadResource
    {
        $unidad = Unidad::create($request->validated());

        return new UnidadResource($unidad);
    }

    public function show(Request $request, Unidad $unidad): UnidadResource
    {
        return new UnidadResource($unidad);
    }

    public function update(UnidadUpdateRequest $request, Unidad $unidad): UnidadResource
    {

        $unidad->update($request->validated());

        return new UnidadResource($unidad);
    }

    public function destroy(Request $request, Unidad $unidad): Response
    {
        $unidad->delete();

        return response()->noContent();
    }
}
