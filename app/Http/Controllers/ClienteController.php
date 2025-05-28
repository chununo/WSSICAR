<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Grupocliente;
use App\Models\Regimenfiscal;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Http\Resources\ClienteCollection;
use App\Http\Resources\ClienteResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ServiceResponse;

class ClienteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Cliente::query();

        if ($request->has('store_id')) {
            $query->where('store_id', $request->input('store_id'));
        }

        $clientes = $query->get();

        return ServiceResponse::success("Lista de clientes ({$clientes->count()})", new ClienteCollection($clientes));
    }

    public function store(ClienteStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $storeId = $data['store_id'];
        $status = 'valid';
        $errors = [];

        // Validación condicional de grupocliente_id
        if (!empty($data['grc_id'])) {
            $data['grupocliente_id'] = Grupocliente::where('store_id', $storeId)
                ->where('grc_id', $data['grc_id'])
                ->value('id');

            if (! $data['grupocliente_id']) {
                $errors['grupocliente_id'] = ["El grupo cliente {$data['grc_id']} no existe en la tienda."];
                $data['grupocliente_id'] = null;
                $status = 'partial';
            }
        }

        // Validación condicional de regimenfiscal_id
        if (!empty($data['rgf_id'])) {
            $data['regimenfiscal_id'] = Regimenfiscal::where('store_id', $storeId)
                ->where('rgf_id', $data['rgf_id'])
                ->value('id');

            if (! $data['regimenfiscal_id']) {
                $errors['regimenfiscal_id'] = ["El régimen fiscal {$data['rgf_id']} no existe en la tienda."];
                $data['regimenfiscal_id'] = null;
                $status = 'partial';
            }
        }

        $data['validation_status'] = $status;
        $data['validation_errors'] = $errors ?: null;

        $cliente = Cliente::create($data);

        return ServiceResponse::success("Cliente ID {$cliente->cli_id} tienda {$cliente->store_id} agregado.", new ClienteResource($cliente));
    }

    public function show(Request $request, Cliente $cliente): JsonResponse
    {
        return ServiceResponse::success("Cliente ID {$cliente->cli_id} tienda {$cliente->store_id}", new ClienteResource($cliente));
    }

    public function update(ClienteUpdateRequest $request, Cliente $cliente): JsonResponse
	{
		$data = $request->validated();
		$storeId = $cliente->store_id;

		// Preservar valores originales por si no se manda validar nuevamente
		$originalStatus = $cliente->validation_status;
		$originalErrors = $cliente->validation_errors ?? [];

		$status = 'valid';
		$errors = [];

		// Validación condicional de grupocliente_id
		if (isset($data['grc_id'])) {
			$data['grupocliente_id'] = Grupocliente::where('store_id', $storeId)
				->where('grc_id', $data['grc_id'])
				->value('id');

			if (! $data['grupocliente_id']) {
				$errors['grupocliente_id'] = ["El grupo cliente {$data['grc_id']} no existe en la tienda."];
				$data['grupocliente_id'] = null;
			} else {
				// Elimina error anterior si existía
				unset($originalErrors['grupocliente_id']);
			}
		}

		// Validación condicional de regimenfiscal_id
		if (isset($data['rgf_id'])) {
			$data['regimenfiscal_id'] = Regimenfiscal::where('store_id', $storeId)
				->where('rgf_id', $data['rgf_id'])
				->value('id');

			if (! $data['regimenfiscal_id']) {
				$errors['regimenfiscal_id'] = ["El régimen fiscal {$data['rgf_id']} no existe en la tienda."];
				$data['regimenfiscal_id'] = null;
			} else {
				unset($originalErrors['regimenfiscal_id']);
			}
		}

		// Combinar errores nuevos con los antiguos restantes
		$combinedErrors = array_merge($originalErrors, $errors);

		$data['validation_errors'] = count($combinedErrors) ? $combinedErrors : null;
		$data['validation_status'] = count($combinedErrors) ? 'partial' : 'valid';

		$cliente->update($data);

		return ServiceResponse::success(
			"Cliente ID {$cliente->cli_id} tienda {$cliente->store_id} actualizado.",
			new ClienteResource($cliente)
		);
	}


    public function destroy(Request $request, Cliente $cliente): JsonResponse
    {
        try {
            $resource = new ClienteResource($cliente);
            $cliente->delete();

            return ServiceResponse::success("Cliente ID {$cliente->cli_id} tienda {$cliente->store_id} eliminado.", $resource);
        } catch (\Throwable $th) {
            return ServiceResponse::error('No se pudo eliminar el cliente.', $th->getTrace(), 500);
        }
    }
}
