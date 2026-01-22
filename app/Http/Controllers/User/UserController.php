<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\CreateUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index(Request $request)
    {

        dd(Auth::attempt($request->all()));
        if (Auth::attempt($request->only('email', 'password'))) {
            dd("ok");
            return response()->json($user, 200);
        }
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }
    public function store(CreateUser $request)
    {

        // dd($request->all());
        $validate = $request->validated();
        // dd($validate);
        $validate['password'] = bcrypt($validate['password']);
        $validate['confirmed'] = bcrypt($validate['confirmed']);
        unset($validate['confirmed']);


        $data = $this->user->create($validate);
        return response()->json($data, 201);
    }
    public function update(UpdateUser $request, User $id)
    {
        $validate = $request->validated();
        if ((isset($validate['password']) && isset($validate['confirmed']))) {
            $validate['password'] = bcrypt($validate['password']);
            unset($validate['confirmed']); {
            }
        }
        $id->update($validate);
        return response()->json(['status' => 'Usuário atualizado com sucesso', 'user' => $id], 200);
    }
}
