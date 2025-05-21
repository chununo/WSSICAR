<?php

namespace App\Http\Controllers;

use App\Models\ArticuloImpuesto;
use App\Models\Articulo;
use App\Models\Impuesto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helpers\ServiceResponse;

class ArticuloImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticuloImpuesto $articuloImpuesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticuloImpuesto $articuloImpuesto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticuloImpuesto $articuloImpuesto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticuloImpuesto $articuloImpuesto)
    {
        //
    }

	public function sync(Request $request, Articulo $articulo): JsonResponse
	{
		$storeId = $articulo->store_id;

		$impuestos = $request->input('impuestos', []);

		$pivotData = [];

		foreach ($impuestos as $imp_id) {
			$errors = [];
			$impuesto = Impuesto::where('store_id', $storeId)
				->where('imp_id', $imp_id)
				->first();

			if (! $impuesto) {
				$errors['imp_id'] = ["Impuesto {$imp_id} no existe en tienda {$storeId}."];
			}

			$pivotData[$imp_id] = [
				'store_id'         => $storeId,
				'articulo_id'      => $articulo->id,
				'impuesto_id'      => $impuesto?->id,
				'validation_status'=> empty($errors) ? 'valid' : 'invalid',
				'validation_errors'=> empty($errors) ? null : $errors,
			];
		}

		$result = $articulo->impuestos()->sync($pivotData);

		return ServiceResponse::success("Articulos-Impuestos agregados exitosamente",$pivotData);
	}

}
