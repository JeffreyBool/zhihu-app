<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
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
            'body.required'=>'内容不能为空!',
            'body.min'=>'内容长度最小不能小于1个字符'
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
            'body'=>'required|min:1',
        ];
    }

}
