<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'project_id' => 'required|exists:projects,id',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'The name field is required.',
        'name.max' => 'The name field cannot exceed 255 characters.',
        'project_id.required' => 'The project field is required.',
        'project_id.exists' => 'The selected project is invalid.',
    ];
}
}
