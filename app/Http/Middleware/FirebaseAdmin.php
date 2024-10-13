<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FirebaseAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('firebase_uid') && Session::get('admin') === true) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'You must be an admin to access this page.');
    }
}
