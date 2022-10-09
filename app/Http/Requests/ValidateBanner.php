<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateBanner extends FormRequest
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
            'header' => 'required|string',
            'product_name' => 'required|string',
            'price' => 'required|integer|min:1',
            'thumb' => 'required',
            'type_banner' => 'required',
            'url' => 'required',
            'order' => 'required|integer',
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
            'header.required' => 'Vui lòng nhập tiêu đề banner',
            'header.string' => 'Tên banner không hợp lệ',
            'product_name.required' => 'Vui lòng nhập tên sản phẩm',
            'product_name.string' => 'Tên sản phẩm không hợp lệ',
            'price.required' => 'Vui lòng nhập giá quảng bá',
            'price.integer' => 'Giá không hợp lệ',
            'price.min:1' => 'Giá không hợp lệ',
            'thumb.required' => 'Vui lòng chọn hình ảnh',
            'type_banner.required' => 'Vui lòng chọn loại banner',
            'url.required' => 'Vui lòng nhập đường dẫn của sản phẩm',
            'order.required' => 'Vui lòng nhập thứ tự hiển thị',
            'order.integer' => 'Thứ tự hiển thị không hợp lệ',
        ];
    }
}
