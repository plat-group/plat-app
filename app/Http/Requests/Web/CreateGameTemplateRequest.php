<?php

namespace App\Http\Requests\Web;

use App\Models\GameTemplate;
use Illuminate\Foundation\Http\FormRequest;

class CreateGameTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', GameTemplate::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'introduction' => ['max:' . FORM_INPUT_MAX_LENGTH],
        ];
    }
}
