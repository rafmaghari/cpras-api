<?php

namespace App\Http\Middleware;

use App\Http\Enums\Roles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== Roles::ADMIN->value) {
            return response()->json([
                'message' => 'Unauthorized. Admin role required.'
            ], 403);
        }

        return $next($request);
    }
}

