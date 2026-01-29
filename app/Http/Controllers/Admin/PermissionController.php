<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreatePermission;
use App\Models\Permission;
use Illuminate\Http\Request;
use PDOException;

class PermissionController extends Controller
{
    public function store(CreatePermission $request)
    {
        $validated = $request->validated();
        /*COloquei o try catch para capturar erros de 
        banco de dados apesar de ter passado pela validação*/
        try {
            Permission::create($validated);
            return response()->json(['status' => 'Permissão criada com sucesso'], 201);
        } catch (PDOException $e) {
            return response()->json(['error' => 'Erro ao criar permissão', 'message' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $permissions = Permission::all();
        return response()->json($permissions, 200);
    }
}
