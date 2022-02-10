<?php

namespace App\Listeners\Traits;

use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;

trait SmartContract
{
    /**
     * Run a commandline
     *
     * @param $command
     *
     * @return bool
     */
    public function commandlineRun($command)
    {
        // $command .= ' > /dev/null 2>&1 &';

        // Write log for debug command line
        Log::debug("command = $command");

        // Execute command
        $process = Process::fromShellCommandline($command, base_path());

        $process->run(function ($type, $buffer) {
            Log::debug($buffer);
        });

        return true;
    }

    /**
     * Convert to Yokto for amount withdraw by Near CLI
     *
     * @param float|int $number
     *
     * @return float
     */
    protected function toYokto($number)
    {
        $val = $number * pow(10, 24) ;  // $number * 1000000000000000000000000;
        return sprintf("%.0f", $val);
    }

    /**
     * Get Near Smart Contract
     *
     * @return string
     */
    protected function getSmartContractId()
    {
        return env('MAIN_SMART_CONTRACT_ID', 'platserver.testnet');
    }
}
