<?php

namespace App\Http\Requests\Role;



use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;



class CreateRole extends FormRequest
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
            "name" => 'required|string|max:255|min:3',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.unique' => 'Função já cadastrada.',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
            'name.max' => 'Campo nome deve ter no máximo 255 caracteres.',
            'name.string' => 'O campo nome deve ser uma string.',
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
