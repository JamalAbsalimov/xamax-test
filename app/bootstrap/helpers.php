<?php

function setEnv($key, $value): void
{
    $pathToEnvFile = base_path() . DIRECTORY_SEPARATOR . '.env';
    file_put_contents($pathToEnvFile, str_replace(
        $key . '=' . env($value),
        $key . '=' . sprintf('"%s"', $value),
        file_get_contents($pathToEnvFile)
    ));
}


/**
 * @return string
 */
function generatePrivateKey(): string
{
    $config = array(
        "digest_alg" => "sha256",
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    );

    $privateKey = openssl_pkey_new($config);
    openssl_pkey_export($privateKey, $privateKeyPem);

    return $privateKeyPem;

}


/**
 * @param string $privateKeyPem
 * @return string
 */
function generatePublicKey(string $privateKeyPem): string
{
    $privateKey = openssl_pkey_get_private($privateKeyPem);
    $publicKey = openssl_pkey_get_details($privateKey)['key'];

    return $publicKey;

}
