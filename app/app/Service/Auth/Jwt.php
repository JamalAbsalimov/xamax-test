<?php

namespace App\Service\Auth;

use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Validator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class Jwt
{
    /**
     * @param string $rawToken
     * @return bool
     */
    public static function verifyToken(string $rawToken): bool
    {
        $publicKey = env('JWT_PUBLIC');

        if (empty($publicKey)) {
            throw new BadRequestException('Server Error');
        }

        $token = (new Parser(new JoseEncoder()))->parse($rawToken);

        $publicKey = InMemory::plainText($publicKey);

        $signer = new Sha256();

        $constraint = new SignedWith($signer, $publicKey);

        return (new Validator())->validate($token, $constraint);
    }
}
