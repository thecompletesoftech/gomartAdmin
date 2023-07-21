<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/banner/create')) {
            return [
                'banner_title' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'banner_image' => 'required',
                'banner_publish' => 'required',
            ];
        } else {
            return [
                'banner_title' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'banner_image' => 'required',
                'banner_publish' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'banner_title.required' => __('validation.required', ['attribute' => 'Banner Title']),
            'banner_image.required' => __('validation.required', ['attribute' => 'Banner Image']),
            'banner_publish.required' => __('validation.required', ['attribute' => 'Banner Publish']),
        ];
    }
}