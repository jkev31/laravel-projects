<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $userRole = $request->session()->get('user_role', 'guest');
        if ($userRole !== $role) {
            return redirect('/dashboard')->with('error', 'Akses ditolak! Anda bukan admin.');
        }
        return $next($request);
    }
}
