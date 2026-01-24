<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!auth()->user()->hasRole('admin')) {
            return response()->json(['Acesso-negado' => 'Seu Usuário não tem permissão para acessar esta funcionalidade'], 403);
        }
        return $next($request);
    }
}
