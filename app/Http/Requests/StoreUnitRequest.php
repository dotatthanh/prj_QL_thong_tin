<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUnitRequest extends FormRequest
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
                Rule::unique('units')->ignore($this->unit),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên đơn vị BĐKT là trường bắt buộc.', 
            'name.max' => 'Tên đơn vị BĐKT không được dài quá :max ký tự.', 
            'name.unique' => 'Đơn vị BĐKT đã tồn tại.', 
        ];
    }
}
