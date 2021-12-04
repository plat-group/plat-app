<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\Game;
use App\Models\GameTemplate;
use App\Models\Order;
use App\Models\User;

class CreateTemplateData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createUserData();
        $this->createGameTemplateData();
        $this->createGameData();
        $this->createOrderData();
        $this->createCampaignData();
        $this->createTransactionData();
    }

    private function createUserData() {
        $user = new User();
        $user->name = 'NghiCreator';
        $user->email = 'creator@plats.network';
        $user->email_verified_at = now();
        // 'password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        $user->password = '$2y$10$.V.lal6ud9lixfGLUI9GtO9dNbn0RgPkGGpbo42p1MKFELIZ6tKbu'; // 11111111
        $user->username = 'platcreator.testnet';
        $user->role = CREATOR_ROLE;
        $user->avatar = 'avatar/user.png';
        $user->balance = 0;
        $user->blocked_balance = 0;
        $user->save();

        $user = new User();
        $user->name = 'NghiClient';
        $user->email = 'client@plats.network';
        $user->email_verified_at = now();
        $user->password = '$2y$10$.V.lal6ud9lixfGLUI9GtO9dNbn0RgPkGGpbo42p1MKFELIZ6tKbu'; // 11111111
        $user->username = 'nghilt.testnet'; // for test
        $user->role = CLIENT_ROLE;
        $user->avatar = 'avatar/client.png';
        $user->balance = 0;
        $user->blocked_balance = 0;
        $user->save();

        $user = new User();
        $user->name = 'NghiReferral';
        $user->email = 'referral@plats.network';
        $user->email_verified_at = now();
        $user->password = '$2y$10$.V.lal6ud9lixfGLUI9GtO9dNbn0RgPkGGpbo42p1MKFELIZ6tKbu'; // 11111111
        $user->username = 'platreferral.testnet';
        $user->role = REFERRAL_ROLE;
        $user->avatar = 'avatar/referral.png';
        $user->balance = 0;
        $user->blocked_balance = 0;
        $user->save();

        $user = new User();
        $user->name = 'NghiUser';
        $user->email = 'user@plats.network';
        $user->email_verified_at = now();
        $user->password = '$2y$10$.V.lal6ud9lixfGLUI9GtO9dNbn0RgPkGGpbo42p1MKFELIZ6tKbu'; // 11111111
        $user->username = 'platuser.testnet';
        $user->role = USER_ROLE;
        $user->avatar = 'avatar/avatar.png';
        $user->balance = 0;
        $user->blocked_balance = 0;
        $user->save();

    }

    private function createGameTemplateData() {
        $creatorId = User::where('email', 'creator@plats.network')->pluck('id')->first();

        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'Supa Racing';
        $game->introduction = 'Supa Racing  features an advanced DirectX 11 graphics engine that recreates an immersive environment';
        $game->description = 'Supa Racing  features an advanced DirectX 11 graphics engine that recreates an immersive environment, dynamic lighthing and realistic materials and surfaces. The advanced physics engine is being designed to provide a very realistic driving experience, including features and aspects of real cars, never seen on any other racing simulator such as tyre flat spots, heat cycles including graining and blistering, very advanced aerodynamic simulation with active movable aerodynamics parts controlled in real time by telemetry input channels, hybrid systems with kers and energy recovery simulation. Extremely detailed with single player and multiplayer options, exclusive licensed cars reproduced with the best accuracy possible, thanks to the official cooperation of Car Manufacturers.';
        $game->thumb = 'game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/toyota_supra.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'Serious Sam';
        $game->introduction = 'Humanity is under siege as the full force of Mental’s hordes spread across the world, ravaging what remains of a broken and beaten civilization.';
        $game->description = '"Humanity is under siege as the full force of Mental’s hordes spread across the world, ravaging what remains of a broken and beaten civilization. The last remaining resistance to the invasion is the Earth Defense Force led by Sam “Serious” Stone and his heavily-armed squad of misfit commandos.

        Croteam returns with a high-powered prequel to the Serious Sam series that scales up chaos to unprecedented levels. The classic Serious Sam formula is revamped by putting an unstoppable arsenal up against an unimaginable number of enemies that requires players to circle-strafe and backpedal-blast their way out of impossible situations."';
        $game->thumb = 'game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/quaivat.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'Samurai Simulator';
        $game->introduction = 'You are a young warrior training in the art of bushido. ';
        $game->description = "You are a young warrior training in the art of bushido. Born in the turbulent times, you cross the country to find your life's purpose in service to one of the powerful Daimyo. Find a lord whose ideals you hold dear, pledge allegiance to him, and lead his family to victory in the struggle for influence and power. Become a true legend among both samurai and local people. Make the right choices and defend your honour to live to old age and train your followers! Rise through the ranks or… start your own clan!";
        $game->thumb = 'game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/girl.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'Formula';
        $game->introduction = 'Simplified F1 rules';
        $game->description = '"Outstanding operability! Maneuver your racing car as you like.
        Simplified F1 rules. Anyone can easily enjoy the fun of racing in VR.
        Spectacular races with 11 CPU racers!
        Choose from 4 unique courses and 3 different cars.
        World leaderboard to showcase your unrivalled speed！"';
        $game->thumb = 'game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/petronas.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'Forza horizon';
        $game->introduction = 'Your Ultimate Horizon Adventure awaits';
        $game->description = '"Your Ultimate Horizon Adventure awaits! Explore the vibrant and ever-evolving open world landscapes of Mexico with limitless, fun driving action in hundreds of the world’s greatest cars.

        This is Your Horizon Adventure
        Lead breathtaking expeditions across the vibrant and ever-evolving open world landscapes of Mexico with limitless, fun driving action in hundreds of the world’s greatest cars.

        This is a Diverse Open World
        Explore a world of striking contrast and beauty. Discover living deserts, lush jungles, historic cities, hidden ruins, pristine beaches, vast canyons and a towering snow-capped volcano.

        This is an Adventurous Open World
        Immerse yourself in a deep campaign with hundreds of challenges that reward you for engaging in the activities you love. Meet new characters and choose the outcomes of their Horizon Story missions.
        "';
        $game->thumb = 'game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/yellow_car.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'iRACING';
        $game->introduction = 'We are the world’s premier computer based motorsports racing simulation/game.';
        $game->description = 'We are the world’s premier computer based motorsports racing simulation/game. An iRacing.com membership provides entry into the newest form of competitive motorsport: internet racing. Internet racing is a fun, easy, and inexpensive way for race fans, simracers and gamers alike to enjoy the thrill of the racetrack from the comfort of their home.';
        $game->thumb = 'game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/bike_tra.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'The Elder Scroll';
        $game->introduction = 'Experience an ever-expanding story across all of Tamriel in The Elder Scrolls Online';
        $game->description = 'Experience an ever-expanding story across all of Tamriel in The Elder Scrolls Online, an award-winning online RPG. Explore a rich, living world with friends or embark upon a solo adventure. Enjoy complete control over how your character looks and plays, from the weapons you wield to the skills you learn – the choices you make will shape your destiny. Welcome to a world without limits.';
        $game->thumb = 'game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/hero.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'DIRT5';
        $game->introduction = 'DIRT 5 is a fun, amplified, off-road arcade racing experience';
        $game->description = 'DIRT 5 is a fun, amplified, off-road arcade racing experience created by Codemasters. Blaze a trail on routes across the world, covering gravel, ice, snow and sand, with a roster of cars ranging from rally icons to trucks, to GT heroes. With a star-studded Career, four-player split-screen, innovative online modes, livery editor and more new features, DIRT 5 is the next generation of extreme racing.';
        $game->thumb = 'game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/bike.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();
    }

    private function createOrderData() {
        $clientId = User::where('email', 'client@plats.network')->pluck('id')->first();
        $gameTemplateId = GameTemplate::pluck('id')->first();
        $gameId = Game::pluck('id')->first();

        $order = new Order();
        $order->client_id = $clientId;
        $order->game_template_id = $gameTemplateId;
        $order->game_id = $gameId;
        $order->content = 'Please change banner image by our banner';
        $order->agreement_amount = 20;
        $order->royalty_fee = 0.05;
        $order->status = ACCEPTED_ORDER_STATUS;
        $order->save();

        $gameTemplateId = GameTemplate::pluck('id')->last();

        $order = new Order();
        $order->client_id = $clientId;
        $order->game_template_id = $gameTemplateId;
        // $order->game_id = $gameId;
        $order->content = 'Please change logo image by our logo';
        $order->agreement_amount = 40;
        $order->royalty_fee = 0.1;
        $order->status = ORDERING_ORDER_STATUS;
        $order->save();
    }

    private function createGameData() {
        $clientId = User::where('email', 'client@plats.network')->pluck('id')->first();

        $game = new Game();
        $game->owner_id = $clientId;
        $game->name = 'Vinfast - iRACING';
        $game->introduction = 'This is a game promote by Vinfast. A Vietnamese Motor company';
        $game->description = 'We are the world’s premier computer based motorsports racing simulation/game. An iRacing.com membership provides entry into the newest form of competitive motorsport: internet racing. Internet racing is a fun, easy, and inexpensive way for race fans, simracers and gamers alike to enjoy the thrill of the racetrack from the comfort of their home.';
        $game->thumb = 'game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/bike_tra.png';
        $game->status = ON_POOL_GAME_STATUS;
        $game->save();
    }

    private function createCampaignData() {
        $gameId = Game::pluck('id')->first();

        $campaign = new Campaign();
        $campaign->game_id = $gameId;
        $campaign->total_budget = 100;
        $campaign->creator_budget = 0.0005;
        $campaign->referral_budget = 0.00006;
        $campaign->user_budget = 0.00008;
        $campaign->start_at = '2021/12/01';
        $campaign->end_at = '2022/12/01';
        $campaign->save();
    }

    private function createTransactionData() {
        \App\Models\Transaction::factory(10)->create();
    }
}