<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTypeRequest extends FormRequest
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
            'name' => [
                'required', 'max:255',
                Rule::unique('types')->ignore($this->type),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên loại thuốc là trường bắt buộc.', 
            'name.max' => 'Tên loại thuốc không được dài quá :max ký tự.', 
            'name.unique' => 'Loại thuốc đã tồn tại.', 
        ];
    }
}
