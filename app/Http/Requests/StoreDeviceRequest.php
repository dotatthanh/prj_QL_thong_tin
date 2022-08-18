<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeviceRequest extends FormRequest
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
                // Rule::unique('devices')->ignore($this->device),
            ],
            'station_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên thiết bị là trường bắt buộc.', 
            'name.max' => 'Tên thiết bị không được dài quá :max ký tự.', 
            // 'name.unique' => 'Thiết bị đã tồn tại.', 
            'station_id.required' => 'Trạm là trường bắt buộc.',
        ];
    }
}
