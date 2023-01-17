<?php

namespace App\Http\Requests;

class AccountFromRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules(): array
    {
        return [
            'user_name' => 'required|min:5',
            'credits' => 'nullable|numeric',
            'user_id' => 'required|integer',
            'type' => 'required|in:personal_account,business_account',
            'cnpj' => 'nullable',
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
            'user_name.required' => 'The :attribute field is required.',
            'user_name.min'=> 'The :attribute must be more that 9 characters.',

            'credits.numeric' => 'The :attribute field must be a numeric.',

            'user_id.required' => 'The :attribute field is required.',
            'user_id.integer' => 'The :attribute must be a integer.',

            'type.required' => 'The :attribute field is required.',
            'type.in' => 'The :attribute must be `personal_account` or `business_account`.',
        ];
    }
}
