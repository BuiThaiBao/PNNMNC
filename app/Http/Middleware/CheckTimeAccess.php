<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTimeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = Carbon::now();
        $startTime = Carbon::parse('00:00:00');
        $endTime = Carbon::parse('23:59:59');
        if ($now->between($startTime, $endTime)) {
            return $next($request);
        } else {
            return response()->json([
                'message' => 'Access denied',
                'time' => $now->format('H:i:s'),
            ], 403);
        }
    }
}
