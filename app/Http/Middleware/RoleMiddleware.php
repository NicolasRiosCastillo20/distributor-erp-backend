<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if(!$user){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userRole = $user->roles->pluck('slug')->toArray();

        $hasRole = count(array_intersect($roles, $userRole)) > 0;

        if (!$hasRole) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
