<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaStoreRequest;
use App\Http\Requests\CategoriaUpdateRequest;
use App\Http\Resources\CategoriaCollection;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{
    public function index(Request $request): CategoriaCollection
    {
        $categoria = Categoria::all();

        return new CategoriaCollection($categoria);
    }

    public function store(CategoriaStoreRequest $request): CategoriaResource
    {
        $categoria = Categoria::create($request->validated());

        return new CategoriaResource($categoria);
    }

    public function show(Request $request, Categoria $categoria): CategoriaResource
    {
        return new CategoriaResource($categoria);
    }

    public function update(CategoriaUpdateRequest $request, Categoria $categoria): CategoriaResource
    {
        $categoria->update($request->validated());

        return new CategoriaResource($categoria);
    }

    public function destroy(Request $request, Categoria $categoria): Response
    {
        $categoria->delete();

        return response()->noContent();
    }
}
