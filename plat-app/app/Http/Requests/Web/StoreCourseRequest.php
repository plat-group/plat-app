<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required'],
            'name' => ['required', 'max:' . FORM_INPUT_MAX_LENGTH],
            'description' => ['required', 'max:' . FORM_INPUT_MAX_LENGTH],
            'thumbnail' => ['image', 'max:3000'],
        ];
    }
}
