<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class FinishGameRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_id'     => ['required', 'uuid'],
            'referral_id' => ['required', 'uuid'],
            'campaign_id' => ['required', 'uuid'],
        ];
    }
}
