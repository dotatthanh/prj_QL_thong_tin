<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:255', 
            'username' => 'required|string|unique:users|max:255',
            'roles' => 'required',
            'password' => 'required|confirmed|min:8|string',
            'unit_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là trường bắt buộc.', 
            'name.max' => 'Họ và tên không được dài quá :max ký tự.', 
            'username.required' => 'Tên đăng nhập là trường bắt buộc.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'username.string' => 'Tên đăng nhập phải là một chuỗi.',
            'username.max' => 'Tên đăng nhập không được dài quá :max ký tự.',
            'roles.required' => 'Vai trò là trường bắt buộc.', 
            'password.required' => 'Mật khẩu là trường bắt buộc!',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'password.string' => 'Mật khẩu phải là một chuỗi',
            'unit_id.required' => 'Đơn vị BĐKT là trường bắt buộc.', 
        ];
    }
}
