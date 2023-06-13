<?php

namespace App\Console\Commands;

use App\Models\EnvCredential;
use Illuminate\Console\Command;

class UpdateENV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $credentials = EnvCredential::get();
        $env = new \CodeZero\DotEnvUpdater\DotEnvUpdater(base_path() . '/.env');
        foreach ($credentials as $credential) {
            $env->set($credential->key, $credential->value);
        }
    }
}
