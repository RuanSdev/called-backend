<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\CreateUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\User\UpdateUser;
use DB;


class UserController extends Controller
{
    protected User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $users = $this->user->paginate(10);
        // dd($users->toArray()["data"]);
        return response()->json($users->items(), 200);
    }
    public function store(CreateUser $request)
    {
        $validate = $request->validated();
        $validate['password'] = bcrypt($validate['password']);
        $company_id = $validate['company_id'];
        $role_id = $validate['role_id'];
        unset($validate['confirmed']);
        unset($validate['company_id']);
        unset($validate['role_id']);



        // $user = \DB::transaction(function () use ($validate) {
        $user = DB::transaction(function () use ($validate, $company_id, $role_id) {
            return $this->user->create($validate);
        });


        $user->companies()->sync([$company_id]);
        $user->roles()->sync([$role_id]);
        // return $user;
        // });

        $user->load('companies', 'roles');
        return response()->json($user, 201);
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
    public function show(User $id)
    {
        return response()->json($id, HTTP_OK);
    }
}
