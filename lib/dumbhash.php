<?php
declare(strict_types=1);

/**
 * @param string $arbitrary
 * @param bool $raw_binary
 * @return string
 * @throws SodiumException
 */
function dumb_hash(string $arbitrary, bool $raw_binary = false): string
{
    $h = sodium_crypto_shorthash($arbitrary, 'SoatokDreamseekr');
    if ($raw_binary) {
        return $h;
    }
    return sodium_bin2hex($h);
}
