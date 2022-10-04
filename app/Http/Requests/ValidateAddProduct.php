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
            'colors' => 'required|array',
            'features' => 'required|array',
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
        ];
    }
}
