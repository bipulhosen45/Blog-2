<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
        return [
            'post_title' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required|numeric',
            'status' => 'required',
            'description' => 'required|min:20',
            'tag_ids' => 'required',
            'image' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'sub_category_id.numaric' => 'Please Select Sub Category'
        ];
    }
}
