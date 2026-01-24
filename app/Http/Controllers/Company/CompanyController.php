<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompany;
use App\Models\Company;
use Exception;


class CompanyController extends Controller
{
    protected Company $company;
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            throw new Exception('Seu Usuário não tem permissão para acessar esta funcionalidade', 403);
        }

        // dd('aqui');
        $data = $this->company->with('users')->get();
        return response()->json($data, 200);
    }
    public function store(CreateCompany $request)
    {
        $validete = $request->validated();
        $data = $this->company->create($validete);


        return response()->json(['status' => 'Empresa criada com sucesso', ["all" => $data]], 201);
    }
}
