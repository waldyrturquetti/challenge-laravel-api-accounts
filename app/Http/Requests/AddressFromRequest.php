<?php

namespace App\Http\Requests;

class AddressFromRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules(): array
    {
        return [
            'zip_code' => 'required|size:9',
            'street' => 'required',
            'complement' => 'nullable',
            'neighborhood' => 'required',
            'city' => 'required',
            'uf' => 'required|size:2',
            'number' => 'required|integer',
            'user_id' => 'required|integer',
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
            'zip_code.required' => 'The :attribute field is required.',
            'zip_code.size'=> 'The :attribute must be 9 characters',

            'street.required' => 'The :attribute field is required.',
            'neighborhood.required' => 'The :attribute field is required.',
            'city.required' => 'The :attribute field is required.',

            'uf.required' => 'The :attribute field is required.',
            'uf.size' => 'The :attribute must be 2 characters.',

            'number.required' => 'The :attribute field is required.',
            'number.integer' => 'The :attribute must be a integer.',

            'user_id.required' => 'The :attribute field is required.',
            'user_id.integer' => 'The :attribute must be a integer.',
        ];
    }
}
