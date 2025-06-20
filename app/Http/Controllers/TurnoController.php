<?php

namespace App\Http\Controllers;

use App\Http\Requests\TurnoStoreRequest;
use App\Http\Requests\TurnoUpdateRequest;
use App\Http\Resources\TurnoCollection;
use App\Http\Resources\TurnoResource;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TurnoController extends Controller
{
    public function index(Request $request): TurnoCollection
    {
		if ($request->has('store_id')) {
			$turnos = Turno::where('store_id', $request->input('store_id'))->get();
		} else {
			$turnos = Turno::all();
		}

        return new TurnoCollection($turnos);
    }

    public function store(TurnoStoreRequest $request): TurnoResource
    {
        $turno = Turno::create($request->validated());

        return new TurnoResource($turno);
    }

    public function show(Request $request, Turno $turno): TurnoResource
    {
        return new TurnoResource($turno);
    }

    public function update(TurnoUpdateRequest $request, Turno $turno): TurnoResource
    {
        $turno->update($request->validated());

        return new TurnoResource($turno);
    }

    public function destroy(Request $request, Turno $turno): Response
    {
        $turno->delete();

        return response()->noContent();
    }
}
