<?php

namespace AdityaDarma\LaravelSsoBroker\Console;

use AdityaDarma\LaravelSsoBroker\LaravelSsoBrokerServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SsoBrokerInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sso-broker:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will publish config file and run a migration for database logging';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        //config
        if (File::exists(config_path('sso-broker.php'))) {
            $confirm = $this->confirm("sso-broker.php config file already exist. Do you want to overwrite?");
            if ($confirm) {
                $this->publishConfig();
                $this->info("config overwrite finished");
            } else {
                $this->info("skipped config publish");
            }
        } else {
            $this->publishConfig();
            $this->info("config published");
        }
    }

    private function publishConfig(): void
    {
        $this->call('vendor:publish', [
            '--provider' => LaravelSsoBrokerServiceProvider::class,
            '--tag'      => 'config',
            '--force'    => true
        ]);
    }
}
