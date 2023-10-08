<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NowLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session()->has('loginVoter') && (url('login') == $request->url() || url('register') == $request->url())) {
            return back();
        }
        if (Session()->has('loginAdmin') && (url('a-login') == $request->url())) {
            return back();
        }

        return $next($request);
    }
}
