<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserStoreRequest;
use App\Http\Requests\StoreUserUpdateRequest;
use App\Models\StoreUser;
use Illuminate\Http\JsonResponse;

class StoreUserController extends Controller
{
    public function index() : JsonResponse
    {
        return response()->json(StoreUser::all());
    }

    public function store(StoreUserStoreRequest $request): JsonResponse
    {
        $store = StoreUser::create($request->validated());
        return empty($store) ? response()->json(null,409) : response()->json($store);
    }

    public function show($store_id, $user_id) : JsonResponse
    {
        $storeUser = StoreUser::where('store_id', $store_id)
        ->where('user_id', $user_id)
        ->first();

        if (!$storeUser) {
        return response()->json(['message' => 'StoreUser not found'], 404);}
        return response()->json($storeUser);
    }

    public function destroy($store_id, $user_id): JsonResponse
    {
        $storeUser = StoreUser::find([$store_id,$user_id]);

        if (!$storeUser) {
            return response()->json(['message' => 'StoreUser no encontrado'], 404);
        }

        $storeUser->delete();

        return response()->json($storeUser);
    }

}
