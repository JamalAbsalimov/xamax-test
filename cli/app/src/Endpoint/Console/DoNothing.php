<?php

declare(strict_types=1);

namespace App\Endpoint\Console;

use Spiral\Boot\DirectoriesInterface;
use Spiral\Console\Attribute\AsCommand;
use Spiral\Console\Attribute\Option;
use Spiral\Console\Command;
use Spiral\Files\FilesInterface;

/**
 * Simple command that does nothing, but demonstrates how to use arguments and options.
 *
 * To execute this command run:
 * php app.php do-nothing foo --times=20
 *
 * Run `php app.php help do-nothing` to see all available options.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[AsCommand(name: 'do-nothing', description: 'The command does nothing.')]
final class DoNothing extends Command
{

    #[Option(shortcut: 't', description: 'Number of times to repeat')]
    private int $times = 10;

    public function __invoke(FilesInterface       $files,
                             DirectoriesInterface $dirs): int
    {
        $privateKey = generatePrivateKey();

        $filePath = $dirs->get('auth') . 'private.pem';

        $files->write($filePath, $privateKey);

        $this->info(generatePublicKey($privateKey));

        return self::SUCCESS;
    }
}
