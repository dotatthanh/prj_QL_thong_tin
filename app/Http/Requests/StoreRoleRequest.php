<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'name' => 'required|max:255|unique:roles', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên vai trò là trường bắt buộc.', 
            'name.max' => 'Tên vai trò không được dài quá :max ký tự.', 
            'name.unique' => 'Tên vai trò đã tồn tại.', 
        ];
    }
}
