<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kontrollo nëse përdoruesi është autentifikuar dhe ka rolin admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Lejo kalimin në rrugën e admin
        }

        // Nëse nuk është admin, kthe një përgjigje të paautorizuar për 'POST', 'PUT', 'DELETE'
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
