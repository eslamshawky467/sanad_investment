<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|max:25|min:8|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'email.email' => trans('admin.emailemsg'),
            'email.required' =>trans('admin.requiremail') ,
            'email.unique' => trans('admin.uniqueemail'),
            'password.required' => trans('admin.requirepass'),
            'name.required' => trans('admin.requirename'),
            'password.min' => trans('admin.passwordmin'),
            'password.max' => trans('admin.passwordmax'),
            'name.max' => trans('admin.namemax'),
            'password.confirmed' => trans('admin.passwordconfirm')
        ];
    }
}
