<?php

namespace App\Http\Controllers;

use App\Http\Requests\{ComboStoreRequest, ComboUpdateRequest};
use App\Http\Resources\{ComboCollection, ComboResource};
use App\Models\{Combo, Grupo, Articulo};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{Auth};
use App\Helpers\ServiceResponse;

class ComboController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $combos = $request->has('store_id')
            ? Combo::where('store_id', $request->input('store_id'))->get()
            : Combo::all();

        return ServiceResponse::success("Lista de combos ({$combos->count()})", new ComboCollection($combos));
    }

    public function store(ComboStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $storeId = $data['store_id'];
        $status = 'valid';
        $errors = [];

		$comboArticulo = Articulo::where('store_id', $storeId)
			->where('art_id', $data['combo'])
			->first();

		if ($comboArticulo) {
			$data['combo_id'] = $comboArticulo->id;
		} else {
			$status = 'partial';
			$errors['combo_id'] = ["El artículo combo {$data['combo']} no existe en la tienda."];
			$data['combo_id'] = null;
		}

        $grupo = Grupo::where('store_id', $storeId)->where('gar_id', $data['grupo'])->first();
        if ($grupo) {
            $data['grupo_id'] = $grupo->id;
        } else {
            $status = 'partial';
            $errors['grupo_id'] = ["El grupo {$data['grupo']} no existe en la tienda."];
            $data['grupo_id'] = null;
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $combo = Combo::create($data);

        return ServiceResponse::success("Combo agregado combo {$combo->combo} grupo {$combo->grupo}", new ComboResource($combo));
    }

    public function show(Request $request, int $combo, int $grupo): JsonResponse
    {
        $user = Auth::user();
        $storeId = $user->store_id ?? $request->query('store_id');

        $combo = Combo::where('store_id', $storeId)
            ->where('combo', $combo)
            ->where('grupo', $grupo)
            ->firstOrFail();

        return ServiceResponse::success("Combo combo {$combo->combo} grupo {$combo->grupo}", new ComboResource($combo));
    }

    public function update(ComboUpdateRequest $request, int $combo, int $grupo): JsonResponse
    {
        $user = Auth::user();
        $storeId = $user->store_id ?? $request->query('store_id');

        $comboRow = Combo::where('store_id', $storeId)
            ->where('combo', $combo)
            ->where('grupo', $grupo)
            ->firstOrFail();

        $data = $request->validated();
        $status = 'valid';
        $errors = [];

		$comboArticulo = Articulo::where('store_id', $storeId)
			->where('art_id', $combo)
			->first();

		if ($comboArticulo) {
			$data['combo_id'] = $comboArticulo->id;
		} else {
			$status = 'partial';
			$errors['combo_id'] = ["El artículo combo $combo no existe en la tienda."];
			$data['combo_id'] = null;
		}

        $grupoServer = Grupo::where('store_id', $storeId)->where('gar_id', $comboRow->grupo)->first();
        if ($grupoServer) {
            $data['grupo_id'] = $grupoServer->id;
        } else {
            $status = 'partial';
            $errors['grupo_id'] = ["El grupo {$grupo} no existe en la tienda."];
            $data['grupo_id'] = null;
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $comboRow->update($data);

        return ServiceResponse::success("Combo actualizado combo {$comboRow->combo} grupo {$comboRow->grupo}", new ComboResource($comboRow));
    }

    public function destroy(Request $request, int $combo, int $grupo): JsonResponse
    {
        $user = Auth::user();
        $storeId = $user->store_id ?? $request->query('store_id');

        $registro = Combo::where('store_id', $storeId)
            ->where('combo', $combo)
            ->where('grupo', $grupo)
            ->first();

        if (! $registro) {
            return ServiceResponse::error("No se encontró combo con id {$combo} grupo {$grupo}", [], 404);
        }

        try {
            $resource = new ComboResource($registro);
            $registro->delete();
            return ServiceResponse::success("Combo eliminado combo {$resource->combo} grupo {$resource->grupo}", $resource);
        } catch (\Throwable $th) {
            return ServiceResponse::error("[SERVER::ERROR]", [$th->getMessage()], 500);
        }
    }
}
