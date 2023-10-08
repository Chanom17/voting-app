<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Voter;

class CheckVoted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $voter_id = $request->route('voter_id');
        $voter = Voter::find($voter_id);
        if ($voter) {
            if ($voter->voted == 1) {
                return back()->with('Error', 'You have already voted.');
            }
            return $next($request);
        }
        return back()->with('Error', 'Voter not found.');
    }
}
