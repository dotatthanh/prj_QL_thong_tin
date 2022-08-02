<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSoftwareRequest extends FormRequest
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
            'image' => 'image',
            'file' => 'mimes:pdf,jpg,jpeg,png,bmp,gif,svg,webp,mp3,mp4,exe,rar,zip',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên phần mềm hỗ trợ là trường bắt buộc.', 
            'name.max' => 'Tên phần mềm hỗ trợ không được dài quá :max ký tự.', 
            'image.image' => 'Ảnh không đúng định dạng (jpg, jpeg, png, bmp, gif, svg hoặc webp).',
            'file.mimes' => 'Tập tin cài đặt không đúng định dạng (jpg, jpeg, png, bmp, gif, svg, pdf, mp3, mp4, exe, rar, zip hoặc webp).',
            // 'file.max' => 'Tập tin cài đặt không được lớn hơn 16MB.',
        ];
    }
}
