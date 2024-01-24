<?php

namespace AdityaDarma\LaravelSsoBroker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string generateTokenFrom(array $data)
 * @method static string generateEncryptTokenFrom(array $data)
 * @method static bool validateToken(string $token)
 * @method static array getPayload()
 *
 * @see \AdityaDarma\LaravelSsoBroker\SsoBroker
 */
class SsoBroker extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sso-broker';
    }
}
