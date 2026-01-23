<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRole;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function store(CreateRole $request)
    {

        $data = $request->validated();
        // dd($data);
        try {
            $role = Role::create($data);
            return response()->json([
                'message' => 'Role created successfully',
                'role' => $role
            ], 201);
        } catch (Exception $e) {
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
