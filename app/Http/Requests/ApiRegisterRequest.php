<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRegisterRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
 
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|min:9|unique:users,phone',
            'password' => 'required',
            'fcm_token' => 'required',
            'image' => 'required',
            'login_type' => 'required',
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
            'name.required' => __('validation.required', ['attribute' => 'First Name']),
            'email.required' => __('validation.required', ['attribute' => 'Email']),
            'phone.required' => __('validation.required', ['attribute' => 'Phone']),
            'fcm_token.required' => __('validation.required', ['attribute' => 'FCM Token']),
            'login_type.required' => __('validation.required', ['attribute' => 'Login type ']),
            'image.required' => __('validation.required', ['attribute' => 'Image']),
            'email.email' => __('validation.email', ['attribute' => 'Email']),
            'email.unique' => __('validation.unique', ['attribute' => 'Email']),
            'password.required' => __('validation.required', ['attribute' => 'Password']),
            'password.strong_password' => __('validation.strong_password', ['attribute' => 'Password']),   
        ];
    }
}