<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (optional(Auth::user())->attributes['is_admin']?? 0 === 1) {
                // Set welcome message for admin
                session()->flash('welcome', 'Welcome Admin!');
            } elseif (optional(Auth::user())->attributes['is_admin']?? 0 === 0) {
                // Set welcome message for non-admin
                session()->flash('welcome', 'Welcome ' . Auth::user()->name . '!');
            }
        }
    
        //dd('Middleware executed');
        return $next($request);

    }

}
