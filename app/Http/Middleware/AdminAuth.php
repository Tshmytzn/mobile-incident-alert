<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin-login')) {
            return $next($request);
        }
        // Check if admin session exists
        if (!Session::has('admin_id')) {
            return redirect('/')->with('error', 'You must log in first.');
        }

        return $next($request);
    }
}
