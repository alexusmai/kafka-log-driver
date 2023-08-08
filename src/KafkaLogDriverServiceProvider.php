<?php

namespace Alexusmai\KafkaLogDriver;

use Illuminate\Support\ServiceProvider;

class KafkaLogDriverServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/kafka_log.php' => config_path('kafka_log.php'),
        ], 'kafka-log-driver-config');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/kafka_log.php',
            'kafka_log'
        );
    }
}
