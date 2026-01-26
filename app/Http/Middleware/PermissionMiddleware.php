<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permissionName): Response
    {
        if (($request->user()->hasRole('admin')) || (auth()->user()->hasPermission($permissionName))) {
            return $next($request);
        }


        return response()->json(['Acesso-negado' => 'Seu Usuário não tem permissão para acessar esta funcionalidade'], 403);



    }
}
