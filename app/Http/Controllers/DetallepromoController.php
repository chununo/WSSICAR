<?php

namespace App\Http\Controllers;

use App\Models\Detallepromo;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\Promocion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DetallepromoStoreRequest;
use App\Http\Requests\DetallepromoUpdateRequest;
use App\Http\Resources\DetallepromoCollection;
use App\Http\Resources\DetallepromoResource;
use App\Helpers\ServiceResponse;

class DetallepromoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Detallepromo::query();

        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }

        $promociones = $query->get();

        return ServiceResponse::success("Lista de detalles de promoción ({$promociones->count()})", new DetallepromoCollection($promociones));
    }

    public function store(DetallepromoStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $storeId = $data['store_id'];
        $status = 'valid';
        $errors = [];

        $data['promocion_id'] = Promocion::where('store_id', $storeId)->where('pro_id', $data['pro_id'])->value('id');
        if (! $data['promocion_id']) {
            $errors['promocion_id'] = ["La promoción {$data['pro_id']} no existe en la tienda."];
            $data['promocion_id'] = null;
            $status = 'partial';
        }

        $data['articulo_id'] = $data['art_id'] ? Articulo::where('store_id', $storeId)->where('art_id', $data['art_id'])->value('id') : null;
        if ($data['art_id'] && ! $data['articulo_id']) {
            $errors['articulo_id'] = ["El artículo {$data['art_id']} no existe en la tienda."];
            $status = 'partial';
        }

        $data['categoria_id'] = $data['cat_id'] ? Categoria::where('store_id', $storeId)->where('cat_id', $data['cat_id'])->value('id') : null;
        if ($data['cat_id'] && ! $data['categoria_id']) {
            $errors['categoria_id'] = ["La categoría {$data['cat_id']} no existe en la tienda."];
            $status = 'partial';
        }

        $data['departamento_id'] = $data['dep_id'] ? Departamento::where('store_id', $storeId)->where('dep_id', $data['dep_id'])->value('id') : null;
        if ($data['dep_id'] && ! $data['departamento_id']) {
            $errors['departamento_id'] = ["El departamento {$data['dep_id']} no existe en la tienda."];
            $status = 'partial';
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $detalle = Detallepromo::create($data);

        return ServiceResponse::success("Detalle de promoción agregado ID {$detalle->dpr_id} del store {$detalle->store_id}", new DetallepromoResource($detalle));
    }

    public function show(Request $request, Detallepromo $detallepromo): JsonResponse
    {
        return ServiceResponse::success("Detalle de promoción ID {$detallepromo->dpr_id}", new DetallepromoResource($detallepromo));
    }

    public function update(DetallepromoUpdateRequest $request, Detallepromo $detallepromo): JsonResponse
    {
        $data = $request->validated();
        $storeId = $detallepromo->store_id;
        $status = 'valid';
        $errors = [];

        if (isset($data['pro_id'])) {
            $data['promocion_id'] = Promocion::where('store_id', $storeId)->where('pro_id', $data['pro_id'])->value('id');
            if (! $data['promocion_id']) {
                $errors['promocion_id'] = ["La promoción {$data['pro_id']} no existe en la tienda."];
                $data['promocion_id'] = null;
                $status = 'partial';
            }
        }

        if (isset($data['art_id'])) {
            $data['articulo_id'] = Articulo::where('store_id', $storeId)->where('art_id', $data['art_id'])->value('id');
            if (! $data['articulo_id']) {
                $errors['articulo_id'] = ["El artículo {$data['art_id']} no existe en la tienda."];
                $data['articulo_id'] = null;
                $status = 'partial';
            }
        }

        if (isset($data['cat_id'])) {
            $data['categoria_id'] = Categoria::where('store_id', $storeId)->where('cat_id', $data['cat_id'])->value('id');
            if (! $data['categoria_id']) {
                $errors['categoria_id'] = ["La categoría {$data['cat_id']} no existe en la tienda."];
                $data['categoria_id'] = null;
                $status = 'partial';
            }
        }

        if (isset($data['dep_id'])) {
            $data['departamento_id'] = Departamento::where('store_id', $storeId)->where('dep_id', $data['dep_id'])->value('id');
            if (! $data['departamento_id']) {
                $errors['departamento_id'] = ["El departamento {$data['dep_id']} no existe en la tienda."];
                $data['departamento_id'] = null;
                $status = 'partial';
            }
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $detallepromo->update($data);

        return ServiceResponse::success("Detalle de promoción actualizado ID {$detallepromo->dpr_id} de la tienda {$detallepromo->store_id}", new DetallepromoResource($detallepromo));
    }

    public function destroy(Request $request, Detallepromo $detallepromo): JsonResponse
    {
        $detallepromo->delete();

        return ServiceResponse::success("Detalle de promoción eliminado ID {$detallepromo->dpr_id} de la tienda {$detallepromo->store_id}", new DetallepromoResource($detallepromo));
    }
}
