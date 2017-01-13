<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'art_title'=>'required',
            'editormd-markdown-doc'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'art_title.required'=>'文章标题不能为空！',
            'editormd-markdown-doc.required'=>'文章内容不能为空!'
        ];
    }
}
