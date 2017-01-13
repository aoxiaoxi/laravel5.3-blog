<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
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
            'link_name'=>'required',
            'link_url'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'link_name.required'=>'名称不能为空!',
            'link_url.required'=>'链接不能为空!',
        ];
    }

}
