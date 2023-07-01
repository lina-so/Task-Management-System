<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب تقديم الاسم',
            'description.required' => 'يجب تقديم الوصف',
            'user_id.required' => 'يجب تحديد معرف المستخدم',
            'user_id.exists' => 'معرف المستخدم غير صالح',
        ];
    }
}
