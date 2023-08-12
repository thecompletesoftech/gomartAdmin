<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function rules()
    {
        if (!request()->is('admin/item/create')) {
            return [
                'item_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'item_price' => 'required',
                'category_name' => 'required',
                'item_publish' => 'required',
                'dis_item_price' => 'required',
                'item_image' => 'required',
                'quantity' => 'required',
                'store_id' => 'required',
                'item_description' => 'required|max:200',
            ];
        } else {
            return [
                'item_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'item_price' => 'required',
                'category_name' => 'required',
                'item_publish' => 'required',
                'dis_item_price' => 'required',
                'item_image' => 'required',
                'quantity' => 'required',
                'store_id' => 'required',
                'item_description' => 'required|max:200',
            ];
        }
    }

    public function messages()
    {
        return [
            'item_name.required' => __('validation.required', ['attribute' => 'item Name']),
            'item_price.required' => __('validation.required', ['attribute' => 'item Price']),
            'category_name.required' => __('validation.required', ['attribute' => 'category Name']),
            'item_publish.required' => __('validation.required', ['attribute' => 'item Publish']),
            'dis_item_price.required' => __('validation.required', ['attribute' => 'item Discount Price']),
            'item_image.required' => __('validation.required', ['attribute' => 'item Image']),
            'quantity.required' => __('validation.required', ['attribute' => 'item Quantity']),
            'quantity.integer' => __('validation.integer', ['attribute' => 'Enter only integer']),
            'item_description.required' => __('validation.required', ['attribute' => 'item description']),
            'store_id.required' => __('validation.required', ['attribute' => 'Store Name']),
        ];
    }
}
