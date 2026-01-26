<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\AuthLogin;
use Exception;

class LoginController extends Controller
{
    public function login(AuthLogin $request)
    {
        $credentials = $request->validated();

        try {
            if ($token = auth('api')->attempt($credentials)) {
                if (auth('api')->user()->is_active === false) {
                    throw new Exception('Usuário inativo. Entre em contato com o administrador do sistema.');
                }
                return response()->json([
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60 . ' segundos',
                    'user' => auth('api')->user(),

                ]);

            }
            throw new Exception('Credenciais inválidas');

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

    }
}
