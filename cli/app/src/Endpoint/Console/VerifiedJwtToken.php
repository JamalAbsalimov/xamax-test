<?php

namespace App\Endpoint\Console;

use App\Auth\Token;
use Spiral\Console\Attribute\AsCommand;
use Spiral\Console\Attribute\Option;
use Spiral\Console\Command;


#[AsCommand(name: 'token-verify', description: 'Скрипт делает запрос с токеном авторизаций на сервер')]
class VerifiedJwtToken extends Command
{
    #[Option(shortcut: 't', description: 'Number of times to repeat')]
    private int $times = 10;

    public function __invoke(Token $token): int
    {
        $rawToken = $token->generate()->toString();

        $curl = curl_init();
        //времени на запрос и получение ответа.
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://172.10.0.2/auth',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $rawToken
            ),
        ));

        curl_exec($curl);

        curl_close($curl);
        $info = curl_getinfo($curl);

        $this->info(<<<MSG
Запрос в url: {$info['url']}
Время запроса: {$info['total_time']}
HTTP Статус: {$info['http_code']}
MSG
        );

        return self::SUCCESS;
    }

}
