<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'email'=>'required|email|unique:clients',
            'password'=>'required|max:25|min:8|confirmed',
            'phone_number'=>'required',
            'identity_card'=>'required',
            'country_id'=>'required',
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
            'password.confirmed' => trans('admin.passwordconfirm'),
            'phone_number'=>trans('admin.requirephone'),
            'identity_card'=>trans('admin.identity_card'),
            'country_id'=>trans('admin.country_id'),

        ];
    }
}
