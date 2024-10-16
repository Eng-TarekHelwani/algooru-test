<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'submissions' => 'required|array|min:1|max:5',
            'submissions.*.assignment_id' => 'required|exists:assignments,id',
            'submissions.*.student_id' => 'required|exists:users,id',
            'submissions.*.submitted_at' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'submissions.*.assignment_id.exists' => 'The selected assignment does not exist in assignments table.',
            'submissions.*.student_id.exists' => 'The selected student does not exist in users table.',
            'submissions.*.submitted_at.date' => 'The submitted_at field must be a valid date.',
        ];
    }
}
