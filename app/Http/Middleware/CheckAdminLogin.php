<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session()->has('loginAdmin')) {
            if (Session()->has('loginVoter')) {
                return redirect('dashboard')->with('Fail', 'this is for admin.');
            } else {
                return redirect('a-login')->with('Fail', 'you need to login first.');
            }
        }
        return $next($request);
    }
}
