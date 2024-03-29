<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAddProduct extends FormRequest
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
            'phone_name' => 'required',
            'price' => 'required|integer',
            'short_description' => 'required',
            'description' => 'required',
            'chip' => 'required',
            'battery' => 'required|integer',
            'front' => 'required',
            'rear' => 'required',
            'size' => 'required',
            'color' => 'required',
            'features' => 'required',
            'discount' => 'nullable|integer'
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
            'phone_name.required'  => 'Vui lòng nhập tên điện thoại',
            'price.required'  => 'Vui lòng nhập giá',
            'price.integer' => 'Giá bán không hợp lệ!',
            'short_description.required' => 'Vui lòng nhập mô tả ngắn',
            'description.required' => 'Vui lòng nhập mô tả chi tiết',
            'chip.required' => 'Vui lòng nhập thông tin vi xử lý',
            'battery.required' => 'Vui lòng nhập dung lượng pin',
            'battery.integer' => 'Thông số dung lượng pin không hợp lệ',
            'front.required' => 'Vui lòng nhập thông số camera trước',
            'rear.required' => 'Vui lòng nhập thông số camera sau',
            'size.required' => 'Vui lòng nhập kích thước điện thoại',
            'color.required' => 'Vui lòng nhập màu sắc',
            'features.required' => 'Vui lòng chọn tính năng của điện thoại',
            'discount.integer' => 'Số tiền giảm giá không hợp lệ'
        ];
    }
}
