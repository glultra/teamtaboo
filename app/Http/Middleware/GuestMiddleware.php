<?php

namespace App\Http\Middleware;

use App\Models\GuestUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guest()) {
//            $guestUser = GuestUser::firstOrNew(['identifier' => 'some_unique_identifier']);
//            Auth::login($guestUser);
        }
        return $next($request);
    }
}
