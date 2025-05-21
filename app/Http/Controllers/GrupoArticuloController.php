<?php

namespace App\Http\Controllers;

use App\Http\Requests\{GrupoArticuloStoreRequest, GrupoArticuloUpdateRequest};
use App\Http\Resources\{GrupoArticuloCollection, GrupoArticuloResource};
use App\Models\{GrupoArticulo, Grupo, Articulo};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{Auth};
use App\Helpers\ServiceResponse;

class GrupoArticuloController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $grupoArticulos = $request->has('store_id')
            ? GrupoArticulo::where('store_id', $request->input('store_id'))->get()
            : GrupoArticulo::all();

        return ServiceResponse::success(
            "Lista de grupo-artículo ({$grupoArticulos->count()})",
            new GrupoArticuloCollection($grupoArticulos)
        );
    }

    public function store(GrupoArticuloStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $storeId = $data['store_id'];
        $status = 'valid';
        $errors = [];

        $grupo = Grupo::where('store_id', $storeId)->where('gar_id', $data['gar_id'])->first();
        if ($grupo) {
            $data['grupo_id'] = $grupo->id;
        } else {
            $status = 'partial';
            $errors['grupo_id'] = ["El grupo {$data['gar_id']} no existe en la tienda."];
            $data['grupo_id'] = null;
        }

        $articulo = Articulo::where('store_id', $storeId)->where('art_id', $data['art_id'])->first();
        if ($articulo) {
            $data['articulo_id'] = $articulo->id;
        } else {
            $status = 'partial';
            $errors['articulo_id'] = ["El artículo {$data['art_id']} no existe en la tienda."];
            $data['articulo_id'] = null;
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $grupoArticulo = GrupoArticulo::create($data);

        return ServiceResponse::success(
            "Grupo-artículo agregado gar_id {$grupoArticulo->gar_id} art_id {$grupoArticulo->art_id}",
            new GrupoArticuloResource($grupoArticulo)
        );
    }

    public function show(Request $request, int $gar_id, int $art_id): JsonResponse
    {
        $storeId = Auth::user()->store_id ?? $request->query('store_id');

        $grupoArticulo = GrupoArticulo::where('store_id', $storeId)
            ->where('gar_id', $gar_id)
            ->where('art_id', $art_id)
            ->firstOrFail();

        return ServiceResponse::success("Grupo-artículo encontrado", new GrupoArticuloResource($grupoArticulo));
    }

    public function update(GrupoArticuloUpdateRequest $request, int $gar_id, int $art_id): JsonResponse
    {
        $storeId = Auth::user()->store_id ?? $request->query('store_id');

        $grupoArticulo = GrupoArticulo::where('store_id', $storeId)
            ->where('gar_id', $gar_id)
            ->where('art_id', $art_id)
            ->firstOrFail();

        $data = $request->validated();
        $status = 'valid';
        $errors = [];

        $grupo = Grupo::where('store_id', $storeId)->where('gar_id', $gar_id)->first();
        $articulo = Articulo::where('store_id', $storeId)->where('art_id', $art_id)->first();

        $data['grupo_id'] = $grupo?->id;
        $data['articulo_id'] = $articulo?->id;

        if (! $grupo) {
            $status = 'partial';
            $errors['grupo_id'] = ["El grupo {$gar_id} no existe en la tienda."];
        }
        if (! $articulo) {
            $status = 'partial';
            $errors['articulo_id'] = ["El artículo {$art_id} no existe en la tienda."];
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $grupoArticulo->update($data);

        return ServiceResponse::success("Grupo-artículo actualizado", new GrupoArticuloResource($grupoArticulo));
    }

    public function destroy(Request $request, int $gar_id, int $art_id): JsonResponse
    {
        $storeId = Auth::user()->store_id ?? $request->query('store_id');

        $grupoArticulo = GrupoArticulo::where('store_id', $storeId)
            ->where('gar_id', $gar_id)
            ->where('art_id', $art_id)
            ->first();

        if (! $grupoArticulo) {
            return ServiceResponse::error("Grupo-artículo no encontrado.", [], 404);
        }

        $resource = new GrupoArticuloResource($grupoArticulo);
        $grupoArticulo->delete();

        return ServiceResponse::success("Grupo-artículo eliminado", $resource);
    }
}
