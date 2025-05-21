<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaqueteStoreRequest;
use App\Http\Requests\PaqueteUpdateRequest;
use App\Http\Resources\PaqueteCollection;
use App\Http\Resources\PaqueteResource;
use App\Models\Paquete;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Helpers\ServiceResponse;

class PaqueteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if ($request->has('store_id')) {
			$paquetes = Paquete::where('store_id', $request->input('store_id'))->get();
		} else {	
			$paquetes = Paquete::all();
		}
		return ServiceResponse::success("Lista de paquetes ({$paquetes->count()})", new PaqueteCollection($paquetes));
    }

    public function store(PaqueteStoreRequest $request): JsonResponse
    {
		$data     = $request->validated();
		Log::info("paquete",$data);
		$storeId  = $data['store_id'];
		$paquete_lc = $data['paquete'];
		$articulo_lc = $data['articulo'];
		$status = 'valid';
		$errors = [];

		$paquete_sv = Articulo::where('store_id',$storeId)
			->where('art_id',$paquete_lc)
			->first();
		if($paquete_sv){
			$data['paquete_id'] = $paquete_sv->id;
		}else{
			$errors['paquete_id'] = ["El artículo del paquete {$paquete_lc} no existe en servidor."];
			$status = 'partial';
			$data['paquete_id'] = null;
		}

		$articulo_sv = Articulo::where('store_id',$storeId)
			->where('art_id',$articulo_lc)
			->first();
		if($articulo_sv){
			$data['articulo_id'] = $articulo_sv->id;
		}else{
			$errors['articulo_id'] = ["El artículo {$articulo_lc} no existe en servidor."];
			$status = 'partial';
			$data['articulo_id'] = null;
		}

		$data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;
		$paquete = Paquete::create($data);

        return ServiceResponse::success("Paquete agregado id {$paquete->paquete} con el artículo {$paquete->articulo} store {$paquete->store_id}",new PaqueteResource($paquete));
    }

    public function show(Request $request, int $paquete, int $articulo): JsonResponse
    {
		/** @var \App\Models\User $user */
		$user = Auth::user();
		$storeId = $user->store_id ?? request('store_id');

		$paquete = Paquete::where('store_id', $storeId)
			->where('paquete', $paquete)
			->where('articulo', $articulo)
			->firstOrFail();

		return ServiceResponse::success("Paquete id {$paquete->paquete} con el artículo {$paquete->articulo} store {$paquete->store_id}",new PaqueteResource($paquete));
    }

    public function update(PaqueteUpdateRequest $request, int $paquete, int $articulo): JsonResponse
	{
		/** @var \App\Models\User $user */
		$user = Auth::user();
		$storeId = $user->store_id ?? $request->query('store_id');

		// Busca el paquete por claves compuestas
		$paqueteRow = Paquete::where('store_id', $storeId)
			->where('paquete', $paquete)
			->where('articulo', $articulo)
			->firstOrFail();

		$data = $request->validated();
		$status = 'valid';
		$errors = [];

		// Reasignar IDs si se requiere
		$paqueteArticulo = Articulo::where('store_id', $storeId)->where('art_id', $paquete)->first();
		$contenidoArticulo = Articulo::where('store_id', $storeId)->where('art_id', $articulo)->first();

		if ($paqueteArticulo) {
			$data['paquete_id'] = $paqueteArticulo->id;
		} else {
			$status = 'partial';
			$errors['paquete_id'] = ["El artículo paquete $paquete no existe en servidor."];
			$data['paquete_id'] = null;
		}

		if ($contenidoArticulo) {
			$data['articulo_id'] = $contenidoArticulo->id;
		} else {
			$status = 'partial';
			$errors['articulo_id'] = ["El artículo contenido $articulo no existe en servidor."];
			$data['articulo_id'] = null;
		}

		$data['validation_status'] = $status;
		$data['validation_errors'] = $errors ?: null;

		$paqueteRow->update($data);

		return ServiceResponse::success("Paquete id {$paqueteRow->paquete} con el artículo {$paqueteRow->articulo} store {$paqueteRow->store_id}",new PaqueteResource($paqueteRow));
	}

    public function destroy(Request $request, int $paquete, int $articulo): JsonResponse
	{
		/** @var \App\Models\User $user */
		$user = Auth::user();

		$storeId = $user->store_id ?? $request->query('store_id');

		$registro = Paquete::where('store_id', $storeId)
			->where('paquete', $paquete)
			->where('articulo', $articulo)
			->first();

		if (! $registro) {
			return ServiceResponse::error("No se encontró paquete con id {$registro->paquete} articulo {$registro->articulo} store {$registro->store}",[],404);
		}

		try {
			$registroResource = new PaqueteResource($registro);
			$registro->delete();
			return ServiceResponse::success("Paquete eliminado id {$registroResource->paquete} con el artículo {$registroResource->articulo} store {$registroResource->store_id}",new PaqueteResource($registroResource));
		} catch (\Throwable $th) {
			return ServiceResponse::error("[SERVER::ERROR]",[$th->getTrace()],404);
		}

	}
}
