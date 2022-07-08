<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceVoucherRequest extends FormRequest
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
            'medical_service_id' => 'required', 
            'user_id' => 'required', 
            'start_date' => 'required|date', 
            'end_date' => 'required|date|after_or_equal:start_date', 
        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'Tên bệnh nhân là trường bắt buộc.', 
            'medical_service_id.required' => 'Dịch vụ khám là trường bắt buộc.', 
            'user_id.required' => 'Bác sĩ là trường bắt buộc.', 
            'start_date.required' => 'Ngày bắt đầu là trường bắt buộc.',
            'start_date.date' => 'Ngày bắt đầu không đúng định dạng.',
            'end_date.required' => 'Ngày kết thúc là trường bắt buộc.',
            'end_date.date' => 'Ngày kết thúc không đúng định dạng.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
        ];
    }
}
