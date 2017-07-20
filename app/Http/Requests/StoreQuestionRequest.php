<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
     * 提示信息
     * @return array
     */
    public function messages ()
    {
        return [
            'title.required'=>'标题不能为空!',
            'title.min'=>'标题不能少于2个字符',
            'title.max'=>'标题不能多于64个字符',
            'content.required'=>'内容不能为空!',
            'content.min'=>'内容长度最小不能小于1个字符'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|min:2|max:64',
            'content'=>'required|min:1',
        ];
    }
}
