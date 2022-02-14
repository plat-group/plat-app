<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_TYPE') == 1) {
            $this->call(CreateTemplateData::class);
            // $this->call(CreateNearGameData::class);
        }else {
            $this->call(CreateTemplateLearningData::class);
        }
    }

    private function createTestData() {
        \App\Models\User::factory(10)->create();
        \App\Models\GameTemplate::factory(10)->create();
        \App\Models\Game::factory(10)->create();
        \App\Models\Campaign::factory(10)->create();
        \App\Models\Transaction::factory(10)->create();
    }
}
