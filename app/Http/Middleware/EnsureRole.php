<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (Session::get('usertype') !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
