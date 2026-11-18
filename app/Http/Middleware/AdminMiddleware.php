<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // If they are not logged in OR not an admin, kick them out
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized. SK Admins only.');
        }

        return $next($request);
    }
}
