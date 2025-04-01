<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function index() : JsonResponse
    {
        return response()->json(Store::all());
    }

    public function store(StoreStoreRequest $request): JsonResponse
    {
        $store = Store::create($request->validated());
        return empty($store) ? response()->json(null,409) : response()->json($store);
    }

    public function show(Store $store) : JsonResponse
    {
        return response()->json($store);
    }

    public function update(StoreUpdateRequest $request, Store $store) : JsonResponse
    {
        $store->update($request->validated());
        $updatedStore = $store->fresh();
        return response()->json($updatedStore);
    }

    public function destroy(Store $store): JsonResponse
    {
        $store->delete();
        return response()->json($store);
    }
}
