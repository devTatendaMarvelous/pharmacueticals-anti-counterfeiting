<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

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
        $this->info('Setting up the project...');
        $this->call('optimize:clear');
        $this->info('Bringing application down for maintenance...');
        $this->call('down');
        $this->info(shell_exec('git stash'));
        $this->info(shell_exec('git pull'));

        $this->info(shell_exec('git stash apply'));

        $this->info('Bringing application up...');
        $this->call('up');

        $this->info('The project is set up!');

        return self::SUCCESS;
    }
}
