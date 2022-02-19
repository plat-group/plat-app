<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\Game;
use App\Models\GameTemplate;
use App\Models\Order;
use App\Models\User;

class CreateTemplateLearningData extends Seeder
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
        $user->name = 'PlatCreator';
        $user->email = 'creator@plats.network';
        $user->email_verified_at = now();
        // 'password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        $user->password = '$2y$10$.V.lal6ud9lixfGLUI9GtO9dNbn0RgPkGGpbo42p1MKFELIZ6tKbu'; // 11111111
        $user->username = 'platcreator.testnet';
        $user->role = CREATOR_ROLE;
        $user->avatar = 'avatar/creative.png';
        $user->balance = 0;
        $user->blocked_balance = 0;
        $user->save();

        $user = new User();
        $user->name = 'PlatArtist';
        $user->email = 'artist@plats.network';
        $user->email_verified_at = now();
        // 'password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        $user->password = '$2y$10$.V.lal6ud9lixfGLUI9GtO9dNbn0RgPkGGpbo42p1MKFELIZ6tKbu'; // 11111111
        $user->username = 'platartist.testnet';
        $user->role = CREATOR_ROLE;
        $user->avatar = 'avatar/creative.png';
        $user->balance = 0;
        $user->blocked_balance = 0;
        $user->save();

        $user = new User();
        $user->name = 'PlatClient';
        $user->email = 'client@plats.network';
        $user->email_verified_at = now();
        $user->password = '$2y$10$.V.lal6ud9lixfGLUI9GtO9dNbn0RgPkGGpbo42p1MKFELIZ6tKbu'; // 11111111
        $user->username = 'platclient.testnet'; // for test
        $user->role = CLIENT_ROLE;
        $user->avatar = 'avatar/client.png';
        $user->balance = 0;
        $user->blocked_balance = 0;
        $user->save();

        $user = new User();
        $user->name = 'PlatReferral';
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
        $user->name = 'PlatUser';
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
        $creatorIds = User::where('role', CREATOR_ROLE)->pluck('id')->all();

        $creatorId = $this->getRandomCreator($creatorIds);
        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'What is NEAR?';
        $game->introduction = 'NEAR is a layer-1 blockchain that is simple to use, super fast, and incredibly secure. ';
        $game->description = 'NEAR is a layer-1 blockchain that is simple to use, super fast, and incredibly secure. NEAR has been awarded the Climate Neutral Product Label from the South Pole and is actively helping users and developers reimagine finance, community, and creativity. Get to grips with what NEAR is, how it works, and discover why it’s so powerful for developers and users.';
        $game->thumb = 'game_template/1ec540bf-d6xd-6c1x-9668-0202a0fb081a/1-What-is-NEAR.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $creatorId = $this->getRandomCreator($creatorIds);
        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'NEAR Wallet & Staking';
        $game->introduction = 'NEAR wallet is a non-custodial, web-based application, that gives you full control over your assets — allowing you to create, play, and stake without restrictions. ';
        $game->description = 'NEAR wallet is a non-custodial, web-based application, that gives you full control over your assets — allowing you to create, play, and stake without restrictions. Sign-up takes just a few clicks, and once complete the world of staking rewards, NFTs, and more will be accessible and easy to use.';
        $game->thumb = 'game_template/1ec540bf-d6xd-6c1x-9668-0202a0fb081a/2-Wallet.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $creatorId = $this->getRandomCreator($creatorIds);
        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'NEAR Sharding in a Nutshell';
        $game->introduction = 'NEAR’s blockchain uses a revolutionary new type of sharding tool called Nightshade to help create infinite scalability and speed. ';
        $game->description = "NEAR’s blockchain uses a revolutionary new type of sharding tool called Nightshade to help create infinite scalability and speed. In this lesson, we explore how it works and why it makes sure the NEAR network is primed for mass adoption.";
        $game->thumb = 'game_template/1ec540bf-d6xd-6c1x-9668-0202a0fb081a/3-Sharding.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $creatorId = $this->getRandomCreator($creatorIds);
        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'The Rainbow Bridge';
        $game->introduction = 'Rainbow Bridge is a gateway to other blockchains. ';
        $game->description = 'Rainbow Bridge is a gateway to other blockchains. The Bridge allows users to seamlessly connect NEAR with other blockchains allowing the movement of tokens into new ecosystems with little more than a few clicks. As a trustless, permissionless tool for cross-chain transfers, it’s the easiest, and simplest way to move assets between NEAR and Ethereum.';
        $game->thumb = 'game_template/1ec540bf-d6xd-6c1x-9668-0202a0fb081a/4-Rainbow-Bridge.png';
        $game->status = ON_MARKET_GAME_STATUS;
        $game->save();

        $creatorId = $this->getRandomCreator($creatorIds);
        $game = new GameTemplate();
        $game->creator_id = $creatorId;
        $game->name = 'What is Aurora?';
        $game->introduction = 'Aurora allows Ethereum\'s most popular applications to leverage NEAR\'s powerful blockchain protocol';
        $game->description = 'Aurora allows Ethereum\'s most popular applications to leverage NEAR\'s powerful blockchain protocol to dramatically increase scalability and efficiency while cutting fees by up to 99.99%.';
        $game->thumb = 'game_template/1ec540bf-d6xd-6c1x-9668-0202a0fb081a/5-Aurora.png';
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
        // $gameTemplate = GameTemplate::where('name', 'Plats game car')->first();

        $game = new Game();
        $game->owner_id = $clientId;

        $game->name = 'What is NEAR?';
        $game->introduction = 'NEAR is a layer-1 blockchain that is simple to use, super fast, and incredibly secure. ';
        $game->description = 'NEAR is a layer-1 blockchain that is simple to use, super fast, and incredibly secure. NEAR has been awarded the Climate Neutral Product Label from the South Pole and is actively helping users and developers reimagine finance, community, and creativity. Get to grips with what NEAR is, how it works, and discover why it’s so powerful for developers and users.';
        $game->thumb = 'game_template/1ec540bf-d6xd-6c1x-9668-0202a0fb081a/1-What-is-NEAR.png';

        $game->status = ON_POOL_GAME_STATUS;
        $game->save();

        $game = new Game();
        $game->owner_id = $clientId;

        $game->name = 'NEAR Wallet & Staking';
        $game->introduction = 'NEAR wallet is a non-custodial, web-based application, that gives you full control over your assets — allowing you to create, play, and stake without restrictions. ';
        $game->description = 'NEAR wallet is a non-custodial, web-based application, that gives you full control over your assets — allowing you to create, play, and stake without restrictions. Sign-up takes just a few clicks, and once complete the world of staking rewards, NFTs, and more will be accessible and easy to use.';
        $game->thumb = 'game_template/1ec540bf-d6xd-6c1x-9668-0202a0fb081a/2-Wallet.png';

        $game->status = ON_POOL_GAME_STATUS;
        $game->save();
    }

    private function createCampaignData() {
        $gameId = Game::pluck('id')->first();

        $campaign = new Campaign();
        $campaign->content_id = $gameId;
        $campaign->content_type = CAMPAIGN_LEARN;
        $campaign->total_budget = 100;
        $campaign->creator_budget = 0.005;
        $campaign->referral_budget = 0.006;
        $campaign->user_budget = 0.008;
        $campaign->start_at = '2022/01/01';
        $campaign->end_at = '2022/12/01';
        $campaign->save();
    }

    private function createTransactionData() {
        \App\Models\Transaction::factory(10)->create();
    }

    private function getRandomCreator($creatorIds) {
        $count = count($creatorIds);
        $idx = rand(0, $count - 1);
        return $creatorIds[$idx];
    }
}
