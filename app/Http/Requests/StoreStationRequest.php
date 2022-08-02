<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStationRequest extends FormRequest
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
                Rule::unique('stations')->ignore($this->station),
            ],
            'phone_number' => 'required',
            'address' => 'required',
            'unit_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên trạm là trường bắt buộc.', 
            'name.max' => 'Tên trạm không được dài quá :max ký tự.', 
            'name.unique' => 'Trạm đã tồn tại.', 
            'phone_number.required' => 'Số điện thoại là trường bắt buộc.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'unit_id.required' => 'Đơn vị BĐKT là trường bắt buộc.',
        ];
    }
}
