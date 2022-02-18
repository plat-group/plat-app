<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class GameTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $creators = User::where('role', CREATOR_ROLE)->pluck('id')->all();
        $gameStatus = [
            CREATING_GAME_STATUS,
            FINISHED_CREATING_GAME_STATUS,
            ON_MARKET_GAME_STATUS,
            ON_POOL_GAME_STATUS
        ];
        return [
            'creator_id' => $this->faker->randomElement($creators),
            'name' => 'Game template ' . $this->faker->numberBetween($min = 1, $max = 40),
            'introduction' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'description' => $this->faker->realText($maxNbChars = 5000, $indexSize = 2),
            'thumb' => $this->faker->imageUrl($width = 640, $height = 480, $category = 'games', $randomize = true, $word = null),
            // 'file'
            'status' => $this->faker->randomElement($gameStatus),
        ];
    }
}
