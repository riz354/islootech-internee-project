<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if ($request->input('token') !== 'my-secret-token') {
        //     return redirect('/');
        // }

        if (Auth::user()->name=='Admin') {
            // User is authenticated, allow the request to proceed
            return $next($request);
        }
        // return redirect('/');
        abort(401);
    }
}
