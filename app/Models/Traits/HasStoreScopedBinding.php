<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

trait HasStoreScopedBinding
{
    public function getRouteKeyName(): string
    {
        return static::$storeLocalKey ?? 'local_id';
    }

    public function resolveRouteBinding($value, $field = null)
    {
		/** @var \App\Models\User $user */
        $user  = Auth::user();
        $field = $field ?? $this->getRouteKeyName();
        $query = static::where($field, $value);

        if (! $user->hasRole('admin')) {
            $query->where('store_id', $user->store_id);
        } elseif ($storeId = request('store_id')) {
            $query->where('store_id', $storeId);
        } elseif ($query->count() > 1) {
            throw ValidationException::withMessages([
                'store_id' => ['Indica la sucursal (store_id).'],
            ]);
        }

        return $query->firstOrFail();
    }
}
