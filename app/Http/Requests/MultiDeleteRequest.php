<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultiDeleteRequest extends FormRequest
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
            'properties_id'=>'required|array|min:1|'
        ];
    }
    public function messages()
    {
        return [
            'properties_id.required' =>trans('admin.requireProperty') ,
            'properties_id.min' =>trans('admin.max_num') ,
 

           
        ];
    }
}
