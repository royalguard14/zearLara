<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class CheckRole
{
public function handle(Request $request, Closure $next, $role)
{
    if (Auth::check() && Auth::user()->role->role_name == $role) {
        return $next($request);
    }

    return redirect('/');
}
}
