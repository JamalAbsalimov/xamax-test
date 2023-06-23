<?php

namespace App\Console\Commands;

use App\Service\Auth\Jwt;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Illuminate\Console\Command;
use Lcobucci\JWT\Validation\Validator;
use Symfony\Component\Console\Exception\LogicException;

class CheckTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:check';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'Проверка токена';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description;

    public function handle(): int
    {
        $rawToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.W10.Sf36q7Xgb8C8tOOKK8VymboUHRlsl6nSUjmug3TySeaF2IsQ8Gy-RHpnBasAJBQezNiMOzrmIDa0MLcoP1i33yy9KjuiNQl2MSAOVKRAkzgK7Gly4uXC75Lh9qzy_27nYoRik2qioZhOmYUc8uHBXvxF69A8VOtDVIyZ7XcgAusXYBQ4deJFwMnDC7tMbt9bVsLm8G30equxXJYSynggCFwbT2HSss0w1Asa3sCgiaA64ji39Qv2gE1SebpSQBTnvXImVYleAb2OQtXNTvha-zCOL2yBxC4fXBjo2Zgy1rXSssrLMmnPrGkZh2_Tos275lFKrEoQHbt60DYdMSbPHg';

        $isValidate = Jwt::verifyToken($rawToken);

        if ($isValidate) {
            // Токен валидный, возвращаем ответ 200 OK
            $this->info('200 OK');
            return Command::SUCCESS;
        }

        throw new LogicException('is not validate');
    }
}
