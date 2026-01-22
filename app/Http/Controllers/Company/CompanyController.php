<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompany;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use League\Uri\Http;

class CompanyController extends Controller
{
    protected Company $company;
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
    public function index()
    {

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
