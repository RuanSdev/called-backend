<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUser extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $this->route('id')->id,
            'password' => 'required_with:confirmed|sometimes|string|min:8|same:confirmed',
            'company_id' => 'sometimes|exists:companies,id',
            'confirmed' => 'required_with:password|sometimes|string|min:8',
        ];
    }
    public function messages()
    {
        return [
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email deve ter no máximo 255 caracteres.',
            'email.unique' => 'O email informado já está em uso.',
            'password.string' => 'O campo senha deve ser uma string.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.required_with' => 'O campo confirmação de senha é obrigatório quando a senha está presente.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'company_id.exists' => 'A empresa informada não existe.',
            'confirmed.string' => 'O campo confirmação de senha deve ser uma string.',
            'confirmed.required_with' => 'O campo confirmação de senha é obrigatório quando a senha está presente.',
            'confirmed.min' => 'A confirmação da senha deve ter no mínimo 8 caracteres.',

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
