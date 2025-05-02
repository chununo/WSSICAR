<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaStoreRequest;
use App\Http\Requests\CategoriaUpdateRequest;
use App\Http\Resources\CategoriaCollection;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{
    public function index(Request $request): CategoriaCollection
    {	
		if ($request->has('store_id')) {
			$categoria = Categoria::where('store_id', $request->input('store_id'))->get();
		} else {	
			$categoria = Categoria::all();
		}

        return new CategoriaCollection($categoria);
    }

    public function store(CategoriaStoreRequest $request): CategoriaResource
    {
        $data     = $request->validated();
		$storeId  = $data['store_id'];
		$depLocal = $data['dep_id'];
		
		$errors = [];
		try {
			$departamento = Departamento::where('store_id', $storeId)
				->where('dep_id', $depLocal)
				->firstOrFail();
			$fkDep = $departamento->dep_id;
			$status = 'valid';
		} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			$fkDep = null;   // o algún valor por defecto
			$errors['dep_id'] = ["El departamento {$depLocal} no existe en la tienda."];
			$status = 'partial';
		}
		
		$categoria = Categoria::create([
			'store_id'         => $storeId,
			'cat_id'           => $data['cat_id'],
			'nombre'           => $data['nombre'],
			'system'           => $data['system'],
			'status'           => $data['status'],
			'dep_id'           => $depLocal,
			'departamento_id'  => $fkDep,
			'validation_status'=> $status,
			'validation_errors'=> $errors ?: null,
			// …
		]);
		
		$resource = (new CategoriaResource($categoria))
			->additional([
				'status'   => $status,
				'warnings' => $errors,
			]);
		
		return $resource;
    }

    public function show(Request $request, Categoria $categoria): CategoriaResource
    {
        return new CategoriaResource($categoria);
    }

    public function update(CategoriaUpdateRequest $request, Categoria $categoria): CategoriaResource
    {
		$data     = $request->validated();
		$storeId  = $categoria->store_id;
		$newDep   = $data['dep_id'] ?? $categoria->dep_id;
	
		// Arrancamos sin errores y status 'valid'
		$errors = [];
		$status = 'valid';
	
		// Si viene nuevo dep_id y difiere, intentamos resolver
		if (($request->has('dep_id')) && $newDep != $categoria->dep_id) {
			$departamento = Departamento::where('store_id', $storeId)
										->where('dep_id', $newDep)
										->first();
	
			if ($departamento) {
				$data['departamento_id'] = $departamento->dep_id;
			} else {
				// no existe: guardado parcial
				$data['departamento_id'] = null;
				$errors['dep_id'] = ["El departamento {$newDep} no existe en la tienda."];
				$status = 'partial';
			}
		} else {
			// si NO cambió, dejamos el fk tal cual
			$data['departamento_id'] = $categoria->departamento_id;
		}
	
		// Siempre guardamos también el estado y errores
		$data['validation_status'] = $status;
		$data['validation_errors'] = $errors ?: null;
	
		// Finalmente actualizamos el modelo
		$categoria->update($data);
	
		// Devolvemos el recurso con warnings si los hay
		return (new CategoriaResource($categoria->refresh()))
			->additional([
				'status'   => $status,
				'warnings' => $errors,
			]);
    }

    public function destroy(Request $request, Categoria $categoria): Response
    {
        $categoria->delete();

        return response()->noContent();
    }
}
