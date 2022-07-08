<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
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
            'patient_id' => 'required', 
            'user_id' => 'required', 
            'prescription_details' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'Tên bệnh nhân là trường bắt buộc.',
            'user_id.required' => 'Bác sĩ là trường bắt buộc.',
            'prescription_details.required' => 'Đơn thuốc chưa có thuốc.', 
        ];
    }
}
