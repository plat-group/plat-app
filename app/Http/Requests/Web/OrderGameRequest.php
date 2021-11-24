<?php

namespace App\Http\Requests\Web;

use App\Models\GameTemplate;
use Illuminate\Foundation\Http\FormRequest;

class OrderGameRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_id'          => ['required', 'uuid'],
            'agreement_amount' => ['required', 'min:0'],
            'royalty_fee'      => ['required', 'min:0'],
        ];
    }
}
