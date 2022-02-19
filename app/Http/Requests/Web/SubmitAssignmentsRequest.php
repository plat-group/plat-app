<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAssignmentsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_id' => ['required'],
            'lesson_id' => ['required'],
            'answered' => ['required', 'array'],
        ];
    }
}
