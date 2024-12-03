<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(auth()->user()->role->role_name !== $role) {
            return response()->json([
                "status" => [
                    "code" => 401,
                    "is_success" => false,
                ],
                "message" => "Unauthorized",
                "data" => null,
            ]);
        }

        return $next($request);
    }
}
