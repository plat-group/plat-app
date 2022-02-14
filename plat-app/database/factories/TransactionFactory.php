<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Campaign;
use App\Models\User;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->all();
        $referrals = User::where('role', REFERRAL_ROLE)->pluck('id')->all();
        $campaigns = Campaign::pluck('id')->all();
        return [
            // 'id' => $this->faker->name(),
            'user_id' => $this->faker->randomElement($users),
            'campaign_id' => $this->faker->randomElement($campaigns),
            'referral_id' => $this->faker->randomElement($referrals),
            'amount' => $this->faker->randomFloat($nbMaxDecimals = 3, $min = 1, $max = 3),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')->format('Y/m/d h:i:s'),
        ];
    }
}
