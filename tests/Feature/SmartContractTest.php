<?php

namespace Tests\Feature;

use App\Listeners\Traits\SmartContract;
use Tests\TestCase;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;

class SmartContractTest extends TestCase
{
    use SmartContract;

    /**
     * A basic test example.
     * vendor/bin/phpunit --filter testCreateGameFast tests/Feature/SmartContractTest.php
     * @return void
     */
    public function testCreateGameFast()
    {
        $smartContractId = $this->getSmartContractId();
        // Call smartcontract to create game information on blockchain
        $command = 'near call ' . $smartContractId . ' create_fast_game \''
                   . $this->makeParameters() . '\''
                   . ' --accountId ' . $smartContractId;
        // // $command = 'near call %s %s \'%s\' --accountId %s';
        // $this->commandlineRun($command);

        $process = Process::fromShellCommandline($command, base_path());

        $process->run(function ($type, $buffer) {
            Log::debug($buffer);
        });
        return true;
    }

    private function makeParameters()
    {

        $result = [
            'game_id' => '10',
            'creator_id' => 'platcreator.testnet',
            'client_id' => 'platclient.testnet',
            'amount_creator' => $this->toYokto(1),
            'amount_referral' => $this->toYokto(2),
            'amount_user' => $this->toYokto(3),
        ];

        return json_encode($result);
    }
}
