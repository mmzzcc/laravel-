<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
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
            'name'=>'required|unique:user|max:20|min:2', 
        ];
    }
    public function messages()
    {
        return [
                'name.required'=>'用户名不能为空',
                'name.unique'=>'用户已存在',
                'mame.max'=>'用户名长度为20个字符',
                'name.min'=>'用户名最短为2个字符'
        ];
    }
}
