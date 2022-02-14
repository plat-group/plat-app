<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Game;

class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $games = Game::pluck('id')->all();
        return [
            'game_id' => $this->faker->randomElement($games),
            'total_budget' => $this->faker->randomFloat($nbMaxDecimals = 4, $min = 100, $max = 500),
            'creator_budget' => $this->faker->randomFloat($nbMaxDecimals = 4, $min = 100, $max = 150),
            'referral_budget' => $this->faker->randomFloat($nbMaxDecimals = 4, $min = 100, $max = 150),
            'user_budget' => $this->faker->randomFloat($nbMaxDecimals = 4, $min = 100, $max = 150),
            'start_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')->format('Y/m/d'),
            'end_at' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '1 years')->format('Y/m/d'),
        ];
    }
}
