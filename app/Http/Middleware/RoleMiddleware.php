<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        $allowedRoles = collect($roles)
            ->flatMap(fn (string $roleGroup) => array_map('trim', explode(',', $roleGroup)))
            ->filter()
            ->values()
            ->all();

        if (! in_array($user->role, $allowedRoles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
