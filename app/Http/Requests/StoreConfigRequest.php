<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConfigRequest extends FormRequest
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
            'conf_name'=>'required',
            'conf_title'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'conf_name.required'=>'配置项名称不能为空！',
            'conf_title.required'=>'配置项标题不能为空！',
        ];
    }
}
