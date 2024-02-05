<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestBlockChainCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->chain();
    }

    function chain()
    {
        $path=base_path().'\verificationContract\contractsData\Transactions.json';
        $abi= json_encode(json_decode(file_get_contents($path),true));
        dd($abi);

    }
}
