<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_role' => ['required', Rule::in(array_keys(trans('app.roles')))],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'name' => ['required'],
            'gender' => ['required', Rule::in(array_keys(trans('app.genders'))) ],
            'birthday' => ['required', 'date' ],
            'password' => ['required' ],
        ];
    }
}
