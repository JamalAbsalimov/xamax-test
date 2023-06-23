<?php

namespace App\Auth;

use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Encoding\UnixTimestampDates;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\UnencryptedToken;
use Spiral\Boot\DirectoriesInterface;
use Spiral\Files\FilesInterface;

readonly class Token
{

    /**
     * @param DirectoriesInterface $dirs
     * @param FilesInterface $files
     */
    public function __construct(
        private DirectoriesInterface $dirs,
        private FilesInterface       $files
    )
    {
    }

    /**
     * @return UnencryptedToken
     */
    public function generate(): UnencryptedToken
    {
        $filePath = $this->dirs->get('auth') . 'private.pem';
        $privateKey = InMemory::plainText($this->files->read($filePath));

        return (new Builder(new JoseEncoder(), new UnixTimestampDates()))->getToken(new Sha256(), $privateKey);
    }
}
