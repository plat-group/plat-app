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
            'username' => ['required', 'unique:App\Models\User,username'],
            'request_role' => ['required', Rule::in(array_keys(trans('app.roles')))],
            'email' => ['required', 'email'],
            'name' => ['required'],
            'gender' => ['required', Rule::in(array_keys(trans('app.genders'))) ],
            'birthday' => ['required', 'date' ],
            'password' => ['required' ],
        ];
    }
}
