<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {  // Admin girisi yoksa login'e yonlendir
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
