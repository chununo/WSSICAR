<?php
namespace App\Http\Controllers;

use App\Models\Regimenfiscal;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegimenfiscalStoreRequest;
use App\Http\Requests\RegimenfiscalUpdateRequest;
use App\Http\Resources\RegimenfiscalCollection;
use App\Http\Resources\RegimenfiscalResource;
use App\Helpers\ServiceResponse;

class RegimenfiscalController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Regimenfiscal::query();

        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }

        $items = $query->get();

        return ServiceResponse::success("Lista de regímenes fiscales ({$items->count()})", new RegimenfiscalCollection($items));
    }

    public function store(RegimenfiscalStoreRequest $request): JsonResponse
    {
        $item = Regimenfiscal::create($request->validated());

        return ServiceResponse::success("Regimen fiscal ID {$item->rgf_id} tienda {$item->store_id} agregado.", new RegimenfiscalResource($item));
    }

    public function show(Request $request, Regimenfiscal $regimenfiscal): JsonResponse
    {
        return ServiceResponse::success("Regimen fiscal ID {$regimenfiscal->rgf_id} tienda {$regimenfiscal->store_id}", new RegimenfiscalResource($regimenfiscal));
    }

    public function update(RegimenfiscalUpdateRequest $request, Regimenfiscal $regimenfiscal): JsonResponse
    {
        $regimenfiscal->update($request->validated());

        return ServiceResponse::success("Regimen fiscal ID {$regimenfiscal->rgf_id} tienda {$regimenfiscal->store_id} actualizado.", new RegimenfiscalResource($regimenfiscal));
    }

    public function destroy(Request $request, Regimenfiscal $regimenfiscal): JsonResponse
    {
        try {
            $resource = new RegimenfiscalResource($regimenfiscal);
            $regimenfiscal->delete();

            return ServiceResponse::success("Regimen fiscal ID {$regimenfiscal->rgf_id} tienda {$regimenfiscal->store_id} eliminado.", $resource);
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar el régimen fiscal.', $th->getTrace(), 500);
        }
    }
}
