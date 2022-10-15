<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateBrand extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'country' => 'required|string',
            'image' => 'required'
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
            'name.required' => 'Vui lòng nhập tên thương hiệu',
            'name.string' => 'Tên thương hiệu không hợp lệ',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.string' => 'Mô tả không hợp lệ',
            'country.required' => 'Vui lòng nhập quốc gia của thương hiệu',
            'country.string' => 'Tên quốc gia không hợp lệ',
            'image.required' => 'Vui lòng chọn hình ảnh',
        ];
    }
}
