<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:110',
            'kind' => 'required',
            'email' => 'required|email|unique:user|min:5|max:255',
            'password' => 'required|min:8|max:32',
            'sex' => 'required',
            'birthday' => 'required|date_format:"d/m/Y"|before:"01/01/2011"|after:"31/12/1949"',
        ];
    }
}
