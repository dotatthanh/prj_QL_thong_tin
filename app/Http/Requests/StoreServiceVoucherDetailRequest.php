<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceVoucherDetailRequest extends FormRequest
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
            'result' => 'required',
            'date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'result.required' => 'Kết quả là trường bắt buộc.',
            'date.required' => 'Ngày khám là trường bắt buộc.',
            'date.date' => 'Ngày khám không đúng định dạng.',
        ];
    }
}
