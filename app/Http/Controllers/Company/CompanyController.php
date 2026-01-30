<?php

namespace App\Http\Controllers\Company;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompany;
use App\Models\Company;
use Exception;
use App\Http\Requests\Company\UpdateCompany;


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


        return ApiResponse::success('Empresa criada com sucesso', $data->attributesToArray(), 201);
    }

    public function show(Company $company)
    {

        $data = $this->company->findOrFail($company->id);

        return ApiResponse::success("Empresa encontrada.", $data->attributesToArray(), 200);
    }

    public function update(UpdateCompany $request, Company $company)
    {
        $validete = $request->validated();
        $data = $company->update($validete);

        if ($data) {

            return ApiResponse::success('Empresa atualizada com sucesso!', $company->attributesToArray(), 200);
        }
        return ApiResponse::error('Erro ao tentar atualizar a empresa.', null, 200);

    }
    public function destroy(Company $company)
    {

        $validete = $company->delete();
        if ($validete) {
            return ApiResponse::success(
                'Empresa deletada com sucesso.',
                $company->attributesToArray(),
                200
            );
        }
        return ApiResponse::error('Erro ao tentar deletar a empresa', null, '');


    }


}
