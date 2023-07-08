<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'name' => 'nullable|min:3|max:255',
            'description' => 'nullable',
            'user_id' => 'nullable|exists:users,id',

        ];


    }

    public function messages()
    {
        return [
        ];
    }
}
