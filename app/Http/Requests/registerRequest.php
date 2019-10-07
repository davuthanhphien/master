<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class registerRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|min:6',
            'retypepassword' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'name không được để trống',
            'email.required'=>'email không để trống',
            'email.unique'=>'email đã tồn tại',
            'email.email'=>'email sai định dạng',
            'email.max'=>'email dài tối đa 50 kí tự',
            'password.required'=>'password không để trống',
            'password.min'=>'password phải ít nhất 8 kí tự',
            'retypepassword.same'=>'password và retypepassword không giống nhau',

        ];
    }
}
