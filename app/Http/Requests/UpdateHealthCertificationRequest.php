<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHealthCertificationRequest extends FormRequest
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
            'conclude' => 'required', 
            'treatment_guide' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'conclude.required' => 'Kết luận là trường bắt buộc.',
            'treatment_guide.required' => 'Hướng dẫn điều trị là trường bắt buộc.', 
        ];
    }
}
