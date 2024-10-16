<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Course name is required',
            'teacher_id.required' => 'teacher id is required',
            'teacher_id.exists' => 'teacher id must exist in users table',
        ];
    }
}
