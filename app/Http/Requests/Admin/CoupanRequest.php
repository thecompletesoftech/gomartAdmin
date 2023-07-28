<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CoupanRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/coupan/create')) {
            return [
                'coupan_code' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'amount' => 'required',
                'discount' => 'required',
                'expiry_date' => 'required',
                'coupan_status' => 'required'
            ];
        } else {
            return [
                'coupan_code' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'amount' => 'required',
                'discount' => 'required',
                'expiry_date' => 'required',
                'coupan_status' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'coupan_code.required' => __('validation.required', ['attribute' => 'Coupan Code']),
            'amount.required' => __('validation.required', ['attribute' => 'Amount']),
            'discount.required' => __('validation.required', ['attribute' => 'Discount']),
            'expiry_date.required' => __('validation.required', ['attribute' => 'Expiry Date']),
            'coupan_status.required' => __('validation.required', ['attribute' => 'Coupan Status']),
        ];
    }
}