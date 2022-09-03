<?php

namespace App\Validators;

use Illuminate\Foundation\Http\FormRequest;


class UploadImageValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param array $params
     *
     * @return array
     */
    protected function rules()
    {
        return [
              'image' => 'required|mimes:jpeg,png,jpg,gif|image|size:9600||dimensions:min_width=100,min_height=100,max_width=1920,max_height=1080'
        ];
    }
}