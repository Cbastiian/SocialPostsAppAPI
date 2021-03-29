<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            auth()->user();
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    "code" => 'TOKEN_INVALID',
                    "detail" => 'Token is Invalid'
                ], 422);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    "code" => 'TOKEN_EXPIRED',
                    "detail" => 'Token is Expired'
                ], 422);
            } else {
                return response()->json([
                    "code" => 'TOKEN_NOT_FOUND',
                    "detail" => 'Authorization Token not found'
                ], 422);
            }
        }
        return $next($request);
    }
}
