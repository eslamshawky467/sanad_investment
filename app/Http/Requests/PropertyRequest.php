<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'title' => 'required|max:255|string',
            'description' => 'required|max:1000|string',
            'total_price' => 'required|numeric|min:0',
            // 'unit_price' => 'required|numeric',
            'total_units' => 'required|numeric|min:0',
            // 'min_investement' => 'required|numeric',
            'last_investement_date' => 'required|date',
            
            'image'=>'required|min:2'
        ];
    }
    public function messages()
    {
        return [
            'title.required' =>trans('admin.requireProperty') ,
            'title.max' =>trans('admin.max_num') ,
            'description.max' =>trans('admin.max_num') ,
            'description.required' =>trans('admin.requiredescription') ,
            'total_price.required' =>trans('admin.requiretotal_price') ,
            'unit_price.required' =>trans('admin.requireunit_price') ,
            'total_units.required' =>trans('admin.requiretotal_units') ,
            'min_investement.required' =>trans('admin.requiremin_investement') ,
            'last_investement_date.required' =>trans('admin.requirelast_investement_date') ,
            'remain_units' =>trans('admin.remain_units') ,
            'image.required'=>trans('admin.file_r'),
            'image.min'=>trans('admin.file_m'),

        ];
    }
}
