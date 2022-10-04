<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRegistration extends FormRequest
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
            'full_name'         => 'required',
            'phone'         => 'required|size:10|regex:/^[0-9]+$/i',
            'gmail'         => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/|unique:users,email',
            'pass'      => 'required|min:6',
            're-pass'       => 'same:pass'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'full_name.required'  => 'Bạn phải nhập tên đăng nhập',
            'phone.required'  => 'Bạn phải nhập số điện thoại',
            'phone.size'  => 'Số điện thoại không hợp lệ',
            'phone.regex'   => 'Số điện thoại không hợp lệ',
            'gmail.required'  => 'Bạn phải nhập email',
            'gmail.unique'  => 'Tên đăng nhập đã tồn tại',
            'gmail.regwx' => 'Email không hợp lệ',
            'pass.required'  => 'Password là trường bắt buộc',
            'pass.min'  => 'Password phải lớn hơn 6 kí tự',
            're-pass.same' => 'Xác nhận password không khớp với password'
        ];
    }
}
