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
                'application_logo' => 'required',
                'application_color' => 'required'
            ];
        } else {
            return [
                'application_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'application_logo' => 'required',
                'application_color' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'application_name.required' => __('validation.required', ['attribute' => 'Application Name']),
            'application_logo.required' => __('validation.required', ['attribute' => 'Application Logo']),
            'application_color.required' => __('validation.required', ['attribute' => 'Application Color']),
        ];
    }
}