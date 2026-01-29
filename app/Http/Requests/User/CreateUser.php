<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUser extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|required_with:confirmed|same:confirmed',
            'company_id' => 'required|exists:companies,id',
            'confirmed' => 'required|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.unique' => 'O email informado já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'company_id.exists' => 'A empresa informada não existe.',
            'confirmed.required' => 'O campo confirmação de senha é obrigatório.',
            'confirmed.min' => 'A confirmação da senha deve ter no mínimo 8 caracteres.',
            'company_id.required' => "O campo empresa é Obrigatório.",
            'role_id.exists' => 'O tipo usuário informado não existe.',
            'role_id.numeric' => 'O id do tipo usuário deve ser um número.',



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
