<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticuloStoreRequest;
use App\Http\Requests\ArticuloUpdateRequest;
use App\Http\Resources\ArticuloCollection;
use App\Http\Resources\ArticuloResource;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Unidad;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ServiceResponse;

class ArticuloController extends Controller
{
    public function index(Request $request): JsonResponse
    {
		// Si se pasa un store_id, filtra por ese ID
		if ($request->has('store_id')) {
			$articulos = Articulo::where('store_id', $request->input('store_id'))->get();
		} else {
			// Si no, devuelve todos los artículos
			$articulos = Articulo::all();
		}

        return ServiceResponse::success("Artículos encontrados ({$articulos->count()})",new ArticuloCollection($articulos));
    }

    public function store(ArticuloStoreRequest $request): JsonResponse
    {
		try {
			$data = $request->validated();
			$storeId = $data['store_id'];
			$catId = $data['cat_id'];
			$unidadCompra = $data['unidadCompra'];
			$unidadVenta = $data['unidadVenta'];
			$status = 'valid';
			$errors = [];
	
			$categoria = Categoria::where('store_id', $storeId)
				->where('cat_id', $catId)
				->first();
			if ($categoria) {
				$data['categoria_id'] = $categoria->id;
			} else {
				$errors['cat_id'] = ["La categoría {$data['cat_id']} no existe en la tienda."];
				$status = 'partial';
				$data['categoria_id'] = null;
			}
			$unidadCompra = Unidad::where('store_id', $storeId)
				->where('uni_id', $unidadCompra)
				->first();
			if ($unidadCompra) {
				$data['unidadCompra_id'] = $unidadCompra->id;
			} else {
				$errors['unidadCompra'] = ["La unidad de compra {$data['unidadCompra']} no existe en la tienda."];
				$status = 'partial';
				$data['unidadCompra_id'] = null;
			}
			$unidadVenta = Unidad::where('store_id', $storeId)
				->where('uni_id', $unidadVenta)
				->first();
			if ($unidadVenta) {
				$data['unidadVenta_id'] = $unidadVenta->id;
			} else {
				$errors['unidadVenta'] = ["La unidad de venta {$data['unidadVenta']} no existe en la tienda."];
				$status = 'partial';
				$data['unidadVenta_id'] = null;
			}
	
			$data['validation_status'] = $status;
			$data['validation_errors'] = $errors ?: null;

			$articulo = Articulo::create($data);
			return ServiceResponse::success("Nuevo artículo id {$articulo->art_id} store {$articulo->store_id}.",new ArticuloResource($articulo));
		} catch (\Throwable $th) {
			return ServiceResponse::error("[SERVER::ERROR] {$th->getMessage()}",$th->getTrace());
		}

    }

    public function show(Request $request, Articulo $articulo): JsonResponse
    {
		
        return ServiceResponse::success("Articulo encontrado ({$articulo->art_id})",new ArticuloResource($articulo));
    }

    public function update(ArticuloUpdateRequest $request, Articulo $articulo): JsonResponse
    {
		$data = $request->validated();
		$storeId = $articulo->store_id;
		$status = 'valid';
		$errors = [];

		try {
			if ($request->has('cat_id') && $data['cat_id'] !== $articulo->cat_id) {
				$cat = Categoria::where('store_id',$storeId)
							   ->where('cat_id',    $data['cat_id'])
							   ->first();
				if ($cat) {
					$data['categoria_id'] = $cat->id;
				} else {
					$errors['cat_id'] = ["La categoría {$data['cat_id']} no existe en la tienda."];
					$status = 'partial';
					$data['categoria_id'] = null;
				}
			}
	
			if ($request->has('unidadCompra') && $data['unidadCompra'] !== $articulo->unidadCompra) {
				$uc = Unidad::where('store_id',$storeId)
							->where('uni_id',  $data['unidadCompra'])
							->first();
				if ($uc) {
					$data['unidadCompra_id'] = $uc->id;
				} else {
					$errors['unidadCompra'] = ["La unidad de compra {$data['unidadCompra']} no existe en la tienda."];
					$status = 'partial';
					$data['unidadCompra_id'] = null;
				}
			}
	
			if ($request->has('unidadVenta') && $data['unidadVenta'] !== $articulo->unidadVenta) {
				$uv = Unidad::where('store_id',$storeId)
							->where('uni_id',  $data['unidadVenta'])
							->first();
				if ($uv) {
					$data['unidadVenta_id'] = $uv->id;
				} else {
					$errors['unidadVenta'] = ["La unidad de venta {$data['unidadVenta']} no existe en la tienda."];
					$status = 'partial';
					$data['unidadVenta_id'] = null;
				}
			}
			$data['validation_status'] = $status;
			$data['validation_errors'] = $errors ?: null;
			$articulo->update($request->validated());

			return ServiceResponse::success("Artículo actualizado id {$articulo->art_id} store {$articulo->store_id}",new ArticuloResource($articulo),$status == 'valid' ? 200:206);
			
		} catch (\Throwable $th) {
			return ServiceResponse::error('[SERVER::ERROR]',$th->getTrace());
		}
    }

    public function destroy(Request $request, Articulo $articulo): JsonResponse
    {
		try {
			$registroResource = new ArticuloResource($articulo);
			$articulo->delete();
			return ServiceResponse::success("Artículo eliminado id {$registroResource->art_id} tienda {$registroResource->store_id}.", $registroResource);
		} catch (\Throwable $th) {
			return ServiceResponse::error('No se encontró artículo.',$th->getTrace(),404);
		}

        
    }
}
