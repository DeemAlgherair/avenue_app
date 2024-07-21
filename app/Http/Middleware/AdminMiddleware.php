<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
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
        if(Auth::check() && Auth::user()->role_id ==1)
        {
            return $next($request);
        }
        else 
        {
            return redirect('/login');
        }
        
    }
}
