<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicineRequest extends FormRequest
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
            'name' => 'required|max:255', 
            'price' => 'required|numeric|min:0',
            'type_id' => 'required',
            'unit' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là trường bắt buộc.', 
            'name.max' => 'Họ và tên không được dài quá :max ký tự.', 
            'price.required' => 'Giá là trường bắt buộc.',
            'price.min' => 'Giá là không được nhỏ hơn :min đồng.',
            'type_id.required' => 'Loại thuốc là trường bắt buộc.',
            'unit.required' => 'Đơn vị tính là trường bắt buộc.',
            'unit.max' => 'Đơn vị tính không được dài quá :max ký tự.',
        ];
    }
}
