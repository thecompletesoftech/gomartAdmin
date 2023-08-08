<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GlobalSettingRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/global/create')) {
            return [
                'application_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'application_color' => 'required',
                'currency_code' => 'required|max:3|min:2|regex:/^[\pL\s\-]+$/u',
                'currency_symbol' => 'required',
                'currency_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
            ];
        } else {
            return [
                'application_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'application_color' => 'required',
                'currency_code' => 'required|max:3|min:2|regex:/^[\pL\s\-]+$/u',
                'currency_symbol' => 'required',
                'currency_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
            ];
        }
    }

    public function messages()
    {
        return [
            'application_name.required' => __('validation.required', ['attribute' => 'Application Name']),
            'application_color.required' => __('validation.required', ['attribute' => 'Application Color']),
            'currency_code.required' => __('validation.required', ['attribute' => 'Currency Code']),
            'currency_symbol.required' => __('validation.required', ['attribute' => 'Currency Symbol']),
            'currency_name.required' => __('validation.required', ['attribute' => 'Currency']),
        ];
    }
}