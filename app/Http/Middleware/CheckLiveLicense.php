<?php

namespace App\Http\Middleware;

use App\Models\License;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CheckLiveLicense
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $currentSessionId = \request()->cookie('session_id');

            $exist = License::query()
                ->where('session_id', $currentSessionId)
                ->firstOrFail();

        } catch (\Throwable $e) {
            Cookie::queue(Cookie::forget('session_id'));

            return response(['error' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
