<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->usertype == 'admin') {
                return $next($request);
            } else {
                return redirect('myhome')->with('error', 'Admin access only!');
            }
        } else {
            return redirect('login')->with('error', 'Please login first.');
        }
    }
}