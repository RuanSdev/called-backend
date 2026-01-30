<?php

namespace App\Http\Requests\Company;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
class UpdateCompany extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guard('api')->hasUser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $companyId = $this->route('company')->id;

        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'address' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                Rule::unique('companies', 'email')->ignore($companyId)
            ],
            'phone' => 'sometimes|string|max:20|min:8',
            'document' => [
                'sometimes',
                'string',
                'max:20',
                Rule::unique('companies', 'document')->ignore($companyId)
            ],
            'trade_name' => 'sometimes|string|max:255',
        ];

    }
    public function messages(): array
    {
        return [
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',

            'email.string' => 'O campo email deve ser uma string.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email deve ter no máximo 255 caracteres.',
            'email.unique' => 'O email informado já está em uso.',
            'phone.string' => 'O campo telefone deve ser uma string.',
            'document.string' => 'O campo Cnpj deve ser uma string.',
            'document.max' => 'O campo Cpnj deve ter no máximo 20 caracteres.',
            'document.unique' => 'O Cnpj informado já está em uso.',
            'trade_name.string' => 'O campo nome fantasia deve ser uma string',

        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Erro de validação',
            'errors' => $validator->errors(),
        ], 422));
    }
}
