<?php

// File: app/Http/Middleware/HandleCors.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleCors
{
    public function handle(Request $request, Closure $next)
    {
        // Configuroni CORS headers manualisht
        return $next($request)
            ->header('Access-Control-Allow-Origin', 'http://localhost:8080')  // Lejo frontend-in tuaj
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')  // Lejo metodat
            ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization, Origin')  // Lejo headers
            ->header('Access-Control-Allow-Credentials', 'false');  // Disable credentials për cookies
    }
}

