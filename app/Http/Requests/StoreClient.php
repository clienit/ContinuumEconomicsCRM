<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'avatar' => 'required|dimensions:min_width=100,min_height=100',
            'email' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'A first name is required',
            'last_name.required' => 'A last name is required',
            'avatar.required' => 'An avatar is required',
            'avatar.dimensions' => 'Minimum avatar dimention has to be 100x100',
            'email.required' => 'A valid email is required',
        ];
    }
}