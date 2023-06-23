<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class GenerateKeyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:key';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'Генерация приватного и публичного ключа';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description;

    public function handle(): int
    {
        if (empty(env('JWT_PRIVATE'))) {
            setEnv('JWT_PRIVATE', generatePrivateKey());
        }

        if (empty(env('JWT_PUBLIC'))) {
            setEnv('JWT_PUBLIC', generatePublicKey(env('JWT_PRIVATE')));
        }


        return CommandAlias::SUCCESS;
    }


}
