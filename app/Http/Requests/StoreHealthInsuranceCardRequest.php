<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHealthInsuranceCardRequest extends FormRequest
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
            'hospital' => 'required|max:255',
            'use_value' => 'required|date|after_or_equal:date_of_issue',
            'id_card' => 'required',
            'date_of_issue' => 'required|date',
            'issued_by' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'Họ và tên là trường bắt buộc.', 
            'hospital.required' => 'Nơi đăng ký khám là trường bắt buộc.',
            'hospital.max' => 'Nơi đăng ký khám không được dài quá :max ký tự.',
            'use_value.required' => 'Giá trị sử dụng là trường bắt buộc.',
            'use_value.date' => 'Giá trị sử dụng không đúng định dạng.',
            'use_value.after_or_equal' => 'Giá trị sử dụng phải lớn hơn hoặc bằng ngày cấp.',
            'id_card.required' => 'Mã thẻ là trường bắt buộc.',
            'date_of_issue.required' => 'Ngày cấp là trường bắt buộc.',
            'date_of_issue.date' => 'Ngày cấp không đúng định dạng.',
            'issued_by.required' => 'Nơi cấp là trường bắt buộc.',
            'issued_by.max' => 'Nơi cấp không được dài quá :max ký tự.',
        ];
    }
}
