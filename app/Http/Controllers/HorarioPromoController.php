<?php

namespace App\Http\Controllers;

use App\Http\Requests\HorarioPromoStoreRequest;
use App\Http\Requests\HorarioPromoUpdateRequest;
use App\Http\Resources\HorarioPromoCollection;
use App\Http\Resources\HorarioPromoResource;
use App\Models\HorarioPromo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ServiceResponse;
use Illuminate\Support\Facades\Log;

class HorarioPromoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if ($request->has('store_id')) {
			$horario = HorarioPromo::where('store_id', $request->input('store_id'))->get();
		} else {	
        	$horario = HorarioPromo::all();
		}
		return ServiceResponse::success("Lista de prohorariomos-horario ({$horario->count()})", new HorarioPromoCollection($horario));
    }

    public function store(HorarioPromoStoreRequest $request): JsonResponse
    {
        $horario = HorarioPromo::create($request->validated());

        return ServiceResponse::success(
            "Horario promocional agregado ID {$horario->hor_id} tienda {$horario->store_id}",
            new HorarioPromoResource($horario)
        );
    }

    public function show(Request $request, HorarioPromo $horarioPromo): JsonResponse
    {
        return ServiceResponse::success(
            "Horario promocional ID {$horarioPromo->hor_id} tienda {$horarioPromo->store_id}",
            new HorarioPromoResource($horarioPromo)
        );
    }

    public function update(HorarioPromoUpdateRequest $request, HorarioPromo $horarioPromo): JsonResponse
    {
        $horarioPromo->update($request->validated());

        return ServiceResponse::success(
            "Horario promocional actualizado ID {$horarioPromo->hor_id} tienda {$horarioPromo->store_id}",
            new HorarioPromoResource($horarioPromo)
        );
    }

    public function destroy(Request $request, HorarioPromo $horarioPromo): JsonResponse
    {
        try {
            $resource = new HorarioPromoResource($horarioPromo);
            $horarioPromo->delete();

            return ServiceResponse::success(
                "Horario promocional eliminado ID {$resource->hor_id} tienda {$resource->store_id}",
                $resource
            );
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar el horario.', $th->getTrace());
        }
    }
}
