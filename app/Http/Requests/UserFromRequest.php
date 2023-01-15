<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFromRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|min:3',
            'email' => 'required|email',
            'birthday' => 'required|date_format:Y-m-d|date',
            'cpf' => 'required|cpf',
            'monthly_income' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo :attribute é obrigatório',
            'nome.min'=> 'O campo Nome precisa ter pelo menos 3 caracteres'
        ];
    }
}
