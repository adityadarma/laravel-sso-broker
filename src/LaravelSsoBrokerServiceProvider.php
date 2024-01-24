<?php

namespace AdityaDarma\LaravelSsoBroker;

use AdityaDarma\LaravelJwtSso\Facades\SsoCrypt;
use AdityaDarma\LaravelJwtSso\Facades\SsoJwt;
use AdityaDarma\LaravelSsoBroker\Console\SsoBrokerInstall;
use Illuminate\Support\ServiceProvider;

class LaravelSsoBrokerServiceProvider extends ServiceProvider
{
    public const CONFIG_PATH = __DIR__ . '/../config/sso-broker.php';


    /**
     * Publish data.
     *
     * @return void
     */
    private function publish(): void
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('sso-broker.php')
        ], 'config');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publish();

        SsoJwt::setSecretKey(config('sso-broker.secret_key'));
        SsoCrypt::setSecretKey(config('sso-broker.secret_key'));
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'sso-broker'
        );

        $this->app->bind('sso-broker', function() {
            return new SsoBroker();
        });

        $this->commands([SsoBrokerInstall::class]);
    }
}
