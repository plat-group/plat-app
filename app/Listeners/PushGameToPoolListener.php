<?php

namespace App\Listeners;

use App\Services\GameService;
use App\Listeners\Traits\SmartContract;
use Symfony\Component\Process\Process;
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

        $result = [
            'game_id' => $gameId,
            'creator_id' => 'platcreator.testnet',
            'client_id' => 'platclient.testnet',
            'amount_creator' => $this->toYokto($campaign->creator_budget),
            'amount_referral' => $this->toYokto($campaign->referral_budget),
            'amount_user' => $this->toYokto($campaign->user_budget),
        ];

        return json_encode($result);
    }

    // /**
    //  * Run a commandline
    //  *
    //  * @param $command
    //  *
    //  * @return bool
    //  */
    // public function commandlineRun($command, $campaign)
    // {
    //     $smartContractId = $this->getSmartContractId();

    //     $process = new Process(['near', 'call', $smartContractId, 'create_fast_game', '\''
    //     . $this->makeParameters($campaign) . '\''
    //     , ' --accountId', $smartContractId]);
    //     $process->run();

    //     $process->run(function ($type, $buffer) {
    //         Log::debug($buffer);
    //     });

    //     return true;
    // }
}
