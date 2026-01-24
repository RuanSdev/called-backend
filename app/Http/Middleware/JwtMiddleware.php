<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth('api')->check()) {
            return response()->json(['message' => 'Não autorizado'], 401);
        }
        $user = JWTAuth::parseToken()->authenticate();
        auth()->setUser($user);
        return $next($request);
    }

}