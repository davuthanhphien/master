<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            'email' => 'required|email|max:50',
            'password' => 'required|min:6|string',
        ];

    }
    public function messages()
    {
        return [
          'email.required'=>'email không để trống',
          'email.email'=>'email sai định dạng',
          'email.max'=>'email dài tối đa 50 kí tự',
          'password.required'=>'password không để trống',
          'password.min'=>'password phải ít nhất 8 kí tự',
          'password.string'=>'password có kí tự đặc biệt',
        ];
    }
}
