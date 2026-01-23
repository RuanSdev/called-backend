<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCompany extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:companies',
            'address' => 'required|string|max:500',
            'email' => 'required|string|email|max:255|unique:companies',
            'phone' => 'required|string|max:20|min:8',
            'document' => 'required|string|max:20|unique:companies',
            'trade_name' => 'required|string|max:255',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.unique' => 'Empresa já cadastrada.',
            'address.required' => 'O campo endereço é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.unique' => 'O email da empresa já está em uso.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'document.required' => 'O campo documento é obrigatório.',
            'document.unique' => 'O documento da empresa já está em uso.',
            'trade_name.required' => 'O campo nome fantasia é obrigatório.',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Erro de validação',
            'errors' => $validator->errors(),
        ], 422));
    }
}
