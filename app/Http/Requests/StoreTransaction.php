<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaction extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => 'required|exists:App\Models\Client,id',
            'transaction_date' => 'required',
            'amount' => 'required'
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
            'client_id.required' => 'Client is required',
            'transaction_date.required' => 'Transaction Date is required',
            'amount.required' => 'Amount is required'
        ];
    }
}