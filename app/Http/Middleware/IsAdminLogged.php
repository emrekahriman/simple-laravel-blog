<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminLogged
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {  // Admin girisi varsa anasayfaya yonlendir
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
