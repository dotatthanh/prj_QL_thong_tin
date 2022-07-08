<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConsultingRoomRequest extends FormRequest
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
                Rule::unique('consulting_rooms')->ignore($this->consulting_room),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên phòng khám là trường bắt buộc.', 
            'name.max' => 'Tên phòng khám không được dài quá :max ký tự.', 
            'name.unique' => 'Phòng khám đã tồn tại.', 
        ];
    }
}
