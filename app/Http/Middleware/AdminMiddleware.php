<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $admin = User::whereHas('roles',function($query){
        //     $query->where('role_name','Admin');
        // })->get();
        // if($admin){
        //      return $next($request);

        // }

        if(Auth::user()->name=='Admin'){
             return $next($request);

        }
        else{
            // return response('Unauthorized', 401);
            return redirect()->route('unauthorized');

        }

    }
}
