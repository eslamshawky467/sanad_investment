<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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

            'title_ar' => 'required|max:30|string',
            'title_en' => 'required|max:30|string',
            'type'     => 'required|max:30|string',
            'body_ar'  => 'required',
            'body_en'  => 'required',
    
        ];
    }


    public function messages()
    {
        return [
            'title_ar.required' =>trans('admin.requireProperty') ,
            'title_ar.max' =>trans('admin.max_num') ,
            'title_en.required' =>trans('admin.requireProperty') ,
            'title_en.max' =>trans('admin.max_num') ,
            'body_ar.required' =>trans('admin.requireProperty') ,
            'body_en.required' =>trans('admin.requireProperty') ,
            'type.required' =>trans('admin.requireProperty') ,
            'type.max' =>trans('admin.max_num') ,

           
        ];
    }
}
