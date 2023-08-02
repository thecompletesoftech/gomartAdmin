<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class EditStoreRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/store/create')) {
            return [
                'store_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'category_name' => 'required',
                'store_phone' => 'required|max:10|min:10',
                'store_address' => 'required',
                'store_description' => 'required',
                'store_latitude' => 'required',
                'store_longitude' => 'required',
                'store_opening_time' => 'required',
                'store_closing_time' => 'required',
                'store_status' => 'required',
                'store_active' => 'required',
            ];
        } else {
            return [
                'store_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'category_name' => 'required',
                'store_phone' => 'required|max:10|min:10',
                'store_address' => 'required',
                'store_description' => 'required',
                'store_latitude' => 'required',
                'store_longitude' => 'required',
                'store_opening_time' => 'required',
                'store_closing_time' => 'required',
                'store_status' => 'required',
                'store_active' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'store_name.required' => __('validation.required', ['attribute' => 'Store Name']),
            'category_name.required' => __('validation.required', ['attribute' => 'Category Name']),
            'store_phone.required' => __('validation.required', ['attribute' => 'Store Phone']),
            'store_address.required' => __('validation.required', ['attribute' => 'Store Address']),
            'store_description.required' => __('validation.required', ['attribute' => 'Store Description']),
            'store_latitude.required' => __('validation.required', ['attribute' => 'Store Latitude']),
            'store_longitude.required' => __('validation.required', ['attribute' => 'Store Longitude']),
            'store_opening_time.required' => __('validation.required', ['attribute' => 'Store Opening Time']),
            'store_closing_time.required' => __('validation.required', ['attribute' => 'Store Closing Time']),
            'store_status.required' => __('validation.required', ['attribute' => 'Store Status']),
            'store_active.required' => __('validation.required', ['attribute' => 'Store Active']),
        ];
    }
}