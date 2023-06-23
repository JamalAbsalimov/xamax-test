<?php

namespace App\Application\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\DirectoriesInterface;

class AppBootloader extends Bootloader
{
    public function boot(DirectoriesInterface $dirs): void
    {
        $dirs->set(
            'uploadDir',
            $dirs->get('root') . '/upload'
        );

        $dirs->set(
            'auth',
            $dirs->get('root') . '/auth'
        );
    }

}
