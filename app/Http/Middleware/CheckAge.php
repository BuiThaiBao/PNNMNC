<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has("age")) {
            return redirect()->route('inputAge');
        }
        if (session("age") < 18) {
            return response()->json([
                'message' => 'Không được phép truy cập',
            ], 403);
        }
        return $next($request);
    }
}
