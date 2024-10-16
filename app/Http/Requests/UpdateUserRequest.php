<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Handle authorization logic if needed
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $this->user,
            'password' => 'sometimes|string|min:5',
            'role' => 'sometimes|in:student,teacher',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email is already in use',
            'role.in' => 'Role must be either student or teacher',
        ];
    }
}
