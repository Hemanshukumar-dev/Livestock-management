<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileIsComplete
{
    /**
     * Redirect owners with incomplete profiles to the completion page.
     * Exempt routes: logout, profile completion routes.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || $user->isAdmin()) {
            return $next($request);
        }

        // Allow these routes even with incomplete profile
        $exemptRoutes = [
            'profile.complete',
            'profile.complete.store',
            'logout',
        ];

        if (in_array($request->route()?->getName(), $exemptRoutes, true)) {
            return $next($request);
        }

        // Check if owner profile exists and is complete
        $owner = $user->owner;
        if (! $owner || $owner->phone === null || $owner->address === null) {
            return redirect()->route('profile.complete');
        }

        return $next($request);
    }
}
