<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\AuthLogin;
use Exception;

class LoginController extends Controller
{
    public function login(AuthLogin $request)
    {
        $credentials = $request->validated();

        try {
            if ($token = auth('api')->attempt($credentials)) {
                return response()->json([
                    'token' => $token,
                    'user' => auth('api')->user()
                ]);

            }
            throw new Exception('Credenciais inválidas');



        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }

    }
}
