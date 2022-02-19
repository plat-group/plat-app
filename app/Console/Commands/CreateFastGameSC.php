<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Listeners\Traits\SmartContract;

class CreateFastGameSC extends Command
{
    use SmartContract;

    const DEFAULT_COURSE_ID1 = 'basic-near-course-1';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sc:create_fast_game';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $contentId = self::DEFAULT_COURSE_ID1;
        $creatorWallet  = 'platcreator.testnet';
        $clientWallet   = 'platclient.testnet';
        $totalBuget     = $this->toYokto(100);
        $amountCreator  = $this->toYokto(1);
        $amountReferral = $this->toYokto(1);
        $amountUser     = $this->toYokto(2);

        // Deposite Plat token from client to smart contract
        $tokenSmartContractId = $this->getTokenSmartContractId();
        $param = $this->makeDepositeParameters($contentId, $totalBuget);
        $cmdFmt = 'near call %s %s \'%s\' --accountId %s --amount 0.000000000000000000000001 --gas 50000000000000 --depositYocto 1';
        $command = sprintf($cmdFmt, $tokenSmartContractId, 'ft_transfer_call', $param, $clientWallet);
        $this->commandlineRun($command);

        // create campaign data on blockchain
        $smartContractId = $this->getSmartContractId();
        $command = sprintf('near call %s %s \'%s\' --accountId %s',
            $smartContractId, 'create_fast_game', $this->makeParameters($contentId, $creatorWallet, $clientWallet, $amountCreator, $amountReferral, $amountUser), $smartContractId);
        $this->commandlineRun($command);
    }

    /**
     * Create parameters of Near CLI command
     *
     * @param $campaign
     * @param string $player
     *
     * @return false|string
     */
    private function makeDepositeParameters($contentId, $totalBuget)
    {
        $result = [
            "receiver_id" => $this->getSmartContractId(),
            "amount" => $totalBuget,
            "msg"  => "{\"game_id\" : \"".$contentId."\"}",
        ];

        return json_encode($result);
    }

    /**
     * Create parameters of Near CLI command
     *
     * @param $campaign
     * @param string $player
     *
     * @return false|string
     */
    private function makeParameters($contentId, $creatorWallet, $clientWallet, $amountCreator, $amountReferral, $amountUser)
    {
        $result = [
            'game_id' => $contentId,
            'creator_id' => $creatorWallet,
            'client_id' => $clientWallet,
            'amount_creator' => $amountCreator,
            "amount_referral" => $amountReferral,
            "amount_user" => $amountUser,
        ];

        return json_encode($result);
    }
}
