<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //
    }
    public function store(CreateUser $request)
    {
        // dd($request->all());
        $validate = $request->validated();
        dd($validate);
        $validate['password'] = bcrypt($validate['password']);
        $validate['confirmed'] = bcrypt($validate['confirmed']);
        unset($validate['confirmed']);
        return response()->json($validate, 201);
    }
}
