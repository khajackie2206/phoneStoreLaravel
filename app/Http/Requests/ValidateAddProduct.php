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
            'phone_name' => 'required|string',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'chip' => 'required|string',
            'battery' => 'required|integer',
            'front' => 'required|string',
            'rear' => 'required|string',
            'size' => 'required',
            'colors' => 'required',
            'features' => 'required',
            'files' => 'required|array',
            'file' => 'required|string'
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
            'phone_name.required'  => 'Vui long nhap ten dien thoai',
            'price.required'  => 'Vui long nhap gia',
            'quantity.required' => 'Vui long nhap so luong',
            'short_description.required' => 'Vui long nhap mo ta ngan',
            'description.required' => 'Vui long nhap mo ta chi tiet',
            'chip.required' => 'Vui long nhap vi xu ly',
            'battery.required' => 'Vui long nhap dung luong pin',
            'front.required' => 'Vui long nhap thong so camera truoc',
            'rear.required' => 'Vui long nhap thong so camera sau',
            'size.required' => 'Vui long nhap thong so man hinh dien thoai',
            'colors.required' => 'Vui long chon mau sac',
            'features.required' => 'Vui long chon tinh nang cua dien thoai'
        ];
    }
}
