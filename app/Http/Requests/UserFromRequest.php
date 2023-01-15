<?php

namespace App\Http\Requests;

class UserFromRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'birthday' => 'required|date_format:Y-m-d|date',
            'cpf' => 'required|cpf',
        ];
    }

    /**
     * Get the error messages for invalids request.
     *
     * @return array
     */
    public static function messages(): array
    {
        return [
            'name.required' => 'The :attribute field is required.',
            'name.min'=> 'The :attribute must be at least 3 characters long.',

            'email.required' => 'The :attribute field is required.',
            'email.email' => 'The :attribute field must be a valid email address.',

            'birthday.required' => 'The :attribute field is required.',
            'birthday.date_format' => 'The :attribute field must be in format Y-m-d.',
            'birthday.date' => 'The :attribute field must be a valid date.',

            'cpf.required' => 'The :attribute field is required.',
            'cpf.cpf' => 'The :attribute must be valid CPF.',
        ];
    }
}
