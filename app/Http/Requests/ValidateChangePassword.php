<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateChangePassword extends FormRequest
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
            'current_password' => 'required|min:6|current_password',
            'new-pass'      => 'required|min:6',
            're-new-pass'   => 'same:new-pass'
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
            'current_password.current_password'  => 'Mật khẩu hiện tại không đúng',
            'old-pass.required'  => 'Bạn phải nhập mật hiện tại',
            'old-pass.min'       => 'Mật khẩu phải lớn hơn 6 kí tự',
            'new-pass.required'  => 'Mật khẩu mới là trường bắt buộc',
            'new-pass.min'       => 'Mật khẩu mới phải lớn hơn 6 kí tự',
            're-new-pass.same'   => 'Xác nhận mật khẩu mới không khớp'
        ];
    }
}
