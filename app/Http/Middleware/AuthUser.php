<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is a user (not admin)
        if (Auth::check() && auth()->user()->isUser()) {
            // Allow access to user routes
            if ($request->is(LaravelLocalization::getCurrentLocale() . '/user*')) {
                return $next($request);
            }
            // Redirect to the welcome page if accessing non-user routes
            return redirect()->route('welcome');
        }

        // Redirect non-user users to the login page
        return redirect()->route('guest_welcome');
    }
}
