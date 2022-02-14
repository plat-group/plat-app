<?php

namespace App\Listeners;

use App\Services\GameService;
use App\Listeners\Traits\SmartContract;
use Illuminate\Support\Facades\Log;

class PushGameToPoolListener
{
    use SmartContract;

    /**
     * @var \App\Services\GameService
     */
    protected $gameService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return boolean
     */
    public function handle($event)
    {
        // TODO: Need interface
        $campaign = $event->campaign;
        $gameId = $campaign->game_id;
        if (!$gameId) {
            return true;
        }

        $smartContractId = $this->getSmartContractId();

        Log::info('call to smartcontract create_fast_game');
        Log::info('param = ' . $this->makeParameters($campaign));
        // Call smartcontract to create game information on blockchain
        $command = 'near call ' . $smartContractId . ' create_fast_game \''
                   . $this->makeParameters($campaign) . '\''
                   . ' --accountId ' . $smartContractId;
        // $command = 'near call %s %s \'%s\' --accountId %s';
        $this->commandlineRun($command);
        // TODO Verify register success on blockchain
        // if(not success) {
        //     return false;
        // }

        // Push game to pool
        $this->gameService->pushToPool($gameId);

        // Finish
        return true;
    }

    /**
     * Create parameters of Near CLI command
     *
     * @param $campaign
     * @param string $player
     *
     * @return false|string
     */
    private function makeParameters($campaign)
    {
        $gameId = $campaign->game_id;

        // $game = $campaign->game();
        // $clientWalletAddress = $game->owner()->wallet_address;
        $clientWalletAddress = 'platclient.testnet';

        // $gameTemplate = $game->order()->gameTemplate();
        // $creatorWalletAddress = $gameTemplate->creator()->wallet_address();
        $creatorWalletAddress = 'platcreator.testnet';

        $result = [
            'game_id' => $gameId,
            'creator_id' => $creatorWalletAddress,
            'client_id' => $clientWalletAddress,
            'amount_creator' => $this->toYokto($campaign->creator_budget),
            'amount_referral' => $this->toYokto($campaign->referral_budget),
            'amount_user' => $this->toYokto($campaign->user_budget),
        ];

        return json_encode($result);
    }
}
