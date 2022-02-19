<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content_id' => ['required', 'uuid'],
            'content_type' => ['required'],
            'total_budget' => ['required', 'numeric', 'min:' . MIN_AMOUNT_CAMPAIGN],
            'creator_budget' => ['required_if:content_type,' . CAMPAIGN_GAME, 'numeric', 'min:' . MIN_AMOUNT_CAMPAIGN],
            'referral_budget' => ['required', 'numeric', 'min:' . MIN_AMOUNT_CAMPAIGN],
            'user_budget' => ['required', 'numeric', 'min:' . MIN_AMOUNT_CAMPAIGN],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $sumBudget = $this->input('creator_budget') + $this->input('referral_budget') + $this->input('user_budget');
            if ($this->input('total_budget') < $sumBudget) {
                $validator
                    ->errors()
                    ->add(
                        'total_budget',
                        trans('validation.total_budget_gte_sum', ['attribute' => 'total budget of campaign'])
                    );
            }
        });
    }
}
