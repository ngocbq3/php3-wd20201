<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestUpdatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'title'       => ['required', 'string', 'max:255', Rule::unique('posts', 'title')->ignore($id)],
            'description' => ['nullable', 'string', 'max:255'],
            'content'     => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp',  'max:2048'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            // Custom message cho từng rule
            'title.required'       => 'Bạn phải nhập tiêu đề bài viết',
            'title.unique'          => 'Tiêu đề bài viết đã tồn tại',
            'title.max'            => 'Tiêu đề không được vượt quá 255 ký tự',
            'description.max'      => 'Mô tả không được vượt quá 255 ký tự',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'category_id.exists'   => 'Danh mục bạn chọn không tồn tại',

            'image.image'    => 'File tải lên phải là một hình ảnh',
            'image.mimes'    => 'Ảnh phải có định dạng: jpg, jpeg, png hoặc webp',
            'image.max'      => 'Dung lượng ảnh không được vượt quá 2MB',
        ];
    }
}
