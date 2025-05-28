<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\NotaStoreRequest;
use App\Http\Requests\NotaUpdateRequest;
use App\Http\Resources\NotaCollection;
use App\Http\Resources\NotaResource;
use App\Helpers\ServiceResponse;
use Illuminate\Http\JsonResponse;

class NotaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Nota::query();

        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }

        $notas = $query->get();

        return ServiceResponse::success("Lista de notas ({$notas->count()})", new NotaCollection($notas));
    }

    public function store(NotaStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $storeId = $data['store_id'];
        $status = 'valid';
        $errors = [];

        // Validación de cliente_id a partir de cli_id
        $data['cliente_id'] = Cliente::where('store_id', $storeId)
            ->where('cli_id', $data['cli_id'])
            ->value('id');

        if (! $data['cliente_id']) {
            $errors['cliente_id'] = ["El cliente con cli_id {$data['cli_id']} no existe en la tienda."];
            $data['cliente_id'] = null;
            $status = 'partial';
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $nota = Nota::create($data);

        return ServiceResponse::success("Nota ID {$nota->not_id} tienda {$nota->store_id} agregada.", new NotaResource($nota));
    }

    public function show(Request $request, Nota $nota): JsonResponse
    {
        return ServiceResponse::success("Nota ID {$nota->not_id} tienda {$nota->store_id}", new NotaResource($nota));
    }

    public function update(NotaUpdateRequest $request, Nota $nota): JsonResponse
    {
        $data = $request->validated();
        $storeId = $nota->store_id;

        $originalStatus = $nota->validation_status;
        $originalErrors = $nota->validation_errors ?? [];

        $status = 'valid';
        $errors = [];

        // Validar cliente si se incluye cli_id
        if (isset($data['cli_id'])) {
            $data['cliente_id'] = Cliente::where('store_id', $storeId)
                ->where('cli_id', $data['cli_id'])
                ->value('id');

            if (! $data['cliente_id']) {
                $errors['cliente_id'] = ["El cliente con cli_id {$data['cli_id']} no existe en la tienda."];
                $data['cliente_id'] = null;
            } else {
                unset($originalErrors['cliente_id']);
            }
        }

        $combinedErrors = array_merge($originalErrors, $errors);
        $data['validation_errors'] = count($combinedErrors) ? $combinedErrors : null;
        $data['validation_status'] = count($combinedErrors) ? 'partial' : 'valid';

        $nota->update($data);

        return ServiceResponse::success("Nota ID {$nota->not_id} tienda {$nota->store_id} actualizada.", new NotaResource($nota));
    }

    public function destroy(Request $request, Nota $nota): JsonResponse
    {
        try {
            $resource = new NotaResource($nota);
            $nota->delete();

            return ServiceResponse::success("Nota ID {$nota->not_id} tienda {$nota->store_id} eliminada.", $resource);
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar la nota.', $th->getTrace(), 500);
        }
    }
}
