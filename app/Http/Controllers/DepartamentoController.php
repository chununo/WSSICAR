<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentoStoreRequest;
use App\Http\Requests\DepartamentoUpdateRequest;
use App\Http\Resources\DepartamentoCollection;
use App\Http\Resources\DepartamentoResource;
use App\Models\Departamento;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartamentoController extends Controller
{
    public function index(Request $request): DepartamentoCollection
    {
        if ($request->has('store_id')) {
			$departamentos = Departamento::where('store_id', $request->input('store_id'))->get();
		} else {
			$departamentos = Departamento::all();
		}
        return new DepartamentoCollection($departamentos);
    }

    public function store(DepartamentoStoreRequest $request): DepartamentoResource
    {
        $departamento = Departamento::create($request->validated());

        return new DepartamentoResource($departamento);
    }

    public function show(Request $request, Departamento $departamento): DepartamentoResource
    {
        return new DepartamentoResource($departamento);
    }

    public function update(DepartamentoUpdateRequest $request, Departamento $departamento): DepartamentoResource
    {
		Log::debug('DepartamentoController@update', [
			'request' => $request->all(),
			'departamento' => $departamento->toArray(),
		]);
        $departamento->update($request->validated());

        return new DepartamentoResource($departamento);
    }

    public function destroy(Request $request, Departamento $departamento): Response
    {
        $departamento->delete();

        return response()->noContent();
    }
}
