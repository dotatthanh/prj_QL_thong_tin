<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentVideoRequest extends FormRequest
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
            'file' => 'required|mimes:mp4',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên tài liệu là trường bắt buộc.', 
            'name.max' => 'Tên tài liệu không được dài quá :max ký tự.', 
            'image.required' => 'Ảnh là trường bắt buộc.',
            'file.required' => 'Tập tin tài liệu là trường bắt buộc.',
            'file.mimes' => 'Tập tin tài liệu không đúng định dạng (mp4).',
        ];
    }
}
