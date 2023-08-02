<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class EditDriverRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/driver/create')) {
            return [
                'driver_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'store_name' => 'required',
                'driver_phone_number' => 'required|max:10|min:10',
                'driver_email' => 'required',
                'driver_address' => 'required|max:200',
            ];
        } else {
            return [
                'driver_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'store_name' => 'required',
                'driver_phone_number' => 'required|max:10|min:10',
                'driver_email' => 'required',
                'driver_address' => 'required|max:200',
            ];
        }
    }

    public function messages()
    {
        return [
            'driver_name.required' => __('validation.required', ['attribute' => 'Driver Name']),
            'store_name.required' => __('validation.required', ['attribute' => 'Store Name']),
            'driver_phone_number.required' => __('validation.required', ['attribute' => 'Driver phone number']),
            'driver_email.required' => __('validation.required', ['attribute' => 'Driver Email']),
            'driver_address.required' => __('validation.required', ['attribute' => 'Driver Address']),
        ];
    }
}