<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $clients = User::where('role', CLIENT_ROLE)->pluck('id')->all();
        $status = [
            CREATING_GAME_STATUS,
            FINISHED_CREATING_GAME_STATUS,
            ON_MARKET_GAME_STATUS,
            ON_POOL_GAME_STATUS
        ];
        return [
            'owner_id' => $this->faker->randomElement($clients),
            'name' => 'Pool Game ' . $this->faker->numberBetween($min = 1, $max = 400),
            'introduction' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'description' => $this->faker->realText($maxNbChars = 5000, $indexSize = 2),
            'thumb' => $this->faker->imageUrl($width = 640, $height = 480, $category = 'games', $randomize = true, $word = null),
            // 'file')->nullable();
            'status' => $this->faker->randomElement($status),
        ];
    }
}
