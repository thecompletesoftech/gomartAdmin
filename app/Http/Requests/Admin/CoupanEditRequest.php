<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CoupanEditRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/coupan/create')) {
            return [
                'coupan_code' => 'required|regex:/^[^\s]+$/',
                'amount' => 'required',
                'discount' => 'required',
                'expiry_date' => 'required',
                'coupan_status' => 'required',
                'discount_type' => 'required',
                'store_id' => 'required',
                'coupon_desc' => 'required|max:200',
            ];
        } else {
            return [
                'coupan_code' => 'required|regex:/^[^\s]+$/',
                'amount' => 'required',
                'discount' => 'required',
                'expiry_date' => 'required',
                'coupan_status' => 'required',
                'discount_type' => 'required',
                'store_id' => 'required',
                'coupon_desc' => 'required|max:200',
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
            'discount_type.required' => __('validation.required', ['attribute' => 'Discount Type']),
            'store_id.required' => __('validation.required', ['attribute' => 'Store Name']),
            'coupon_desc.required' => __('validation.required', ['attribute' => 'Coupon Description']),
        ];
    }
}