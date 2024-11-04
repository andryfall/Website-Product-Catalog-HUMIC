<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('admin')) {
            return redirect('/login')->withErrors(['Please log in to access this page.']);
        }

        return $next($request);
    }
}
