<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMedicalServiceRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'name' => [
                'required', 'max:255',
                Rule::unique('medical_services')->ignore($this->medical_service),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên dịch vụ khám là trường bắt buộc.', 
            'name.max' => 'Tên dịch vụ khám không được dài quá :max ký tự.', 
            'name.unique' => 'Dịch vụ khám đã tồn tại.', 
            'price.required' => 'Giá dịch vụ khám là trường bắt buộc.', 
            'price.min' => 'Giá dịch vụ khám phải ít nhất là :min đồng.', 
        ];
    }
}
