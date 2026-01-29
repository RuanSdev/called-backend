<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRole;
use App\Models\Role;
use PDOException;
use Exception;

class RoleController extends Controller
{
    public function index()
    {


        $roles = Role::all();
        return response()->json($roles, 200);
    }
    public function store(CreateRole $request)
    {

        if (!auth()->user()->hasRole('admin')) {
            throw new Exception('Seu Usuário não tem permissão para acessar esta funcionalidade', 403);
        }

        $data = $request->validated();

        try {
            $role = Role::create($data);
            return response()->json([
                'message' => 'Role created successfully',
                'role' => $role
            ], 201);
        } catch (PDOException $e) {
            return response()->json([
                'message' => 'Error creating role',
                'error' => $e->getMessage()
            ], 500);
        }


    }
    public function show(string $id)
    {

        try {
            $role = Role::findOrFail($id);
            return response()->json(
                $role
                ,
                200
            );
        } catch (Exception $e) {
            $e = new Exception('Não encontrado', 404);
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
    }

}
