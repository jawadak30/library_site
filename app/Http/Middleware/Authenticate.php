<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            if (! Auth::check()) {
                $locale = LaravelLocalization::getCurrentLocale();
                if ($request->is(LaravelLocalization::getCurrentLocale() . '/user*')) {
                    return redirect(LaravelLocalization::getLocalizedURL($locale, route('guest_welcome')));
                }
                if ($request->is(LaravelLocalization::getCurrentLocale() . '/admin*')) {
                    return redirect(LaravelLocalization::getLocalizedURL($locale, route('guest_welcome')));
                }
            }
            return $next($request);
    }
}
