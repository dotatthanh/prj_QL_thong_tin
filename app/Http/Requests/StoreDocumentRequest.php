<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'image' => 'required|image',
            'file' => 'required|mimes:pdf,jpg,jpeg,png,bmp,gif,svg,webp,mp3,mp4|max:16000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên tài liệu là trường bắt buộc.', 
            'name.max' => 'Tên tài liệu không được dài quá :max ký tự.', 
            'image.required' => 'Ảnh là trường bắt buộc.',
            'image.image' => 'Ảnh không đúng định dạng (jpg, jpeg, png, bmp, gif, svg hoặc webp).',
            'file.required' => 'Tập tin tài liệu là trường bắt buộc.',
            'file.mimes' => 'Tập tin tài liệu không đúng định dạng (jpg, jpeg, png, bmp, gif, svg, pdf, mp3, mp4 hoặc webp).',
            'file.max' => 'Tập tin tài liệu không được lớn hơn 16MB.',
        ];
    }
}
