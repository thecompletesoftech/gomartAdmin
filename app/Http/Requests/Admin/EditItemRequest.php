<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditItemRequest extends FormRequest
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
                'item_weight' => 'required|regex:/(^[A-Za-z0-9\s]+$)+/',
                'quantity' => 'required',
                'store_id' => 'required',
                'item_expiry_date' => 'required',
                'item_description' => 'required|max:200',
            ];
        } else {
            return [
                'item_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'item_price' => 'required',
                'category_name' => 'required',
                'item_publish' => 'required',
                'dis_item_price' => 'required',
                'item_weight' => 'required|regex:/(^[A-Za-z0-9\s]+$)+/',
                'quantity' => 'required',
                'store_id' => 'required',
                'item_expiry_date' => 'required',
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
            'item_weight.required' => __('validation.required', ['attribute' => 'item Weight']),
            'quantity.required' => __('validation.required', ['attribute' => 'item Quantity']),
            'quantity.integer' => __('validation.integer', ['attribute' => 'Enter only integer']),
            'item_description.required' => __('validation.required', ['attribute' => 'item description']),
            'item_expiry_date.required' => __('validation.required', ['attribute' => 'item expiry date']),
            'store_id.required' => __('validation.required', ['attribute' => 'Store Name']),
        ];
    }
}