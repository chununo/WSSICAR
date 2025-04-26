<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class haveStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		if (! Auth::check()) {                 // usuario no autenticado
            abort(401);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1️⃣  Si es ADMIN pasa directo
        if ($user->hasRole('admin')) {         // ← Spatie
            return $next($request);
        }

        // 2️⃣  Si tiene store_id pasa y lo agrega al request
        if ($user->store_id) {
            $request->merge(['store_id' => $user->store_id]);
            return $next($request);
        }

        // 3️⃣  Cualquier otro caso: prohibido
        abort(403);
        
    }
}