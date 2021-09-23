<?php

namespace Sumian\DingtalkErrorNotifier;

use Monolog\Logger;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Illuminate\Support\ServiceProvider;

class DingtalkErrorNotifierServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(realpath(__DIR__ . '/../config/notifier.php'), 'notifier');
        $this->publishes([
            realpath(__DIR__ . '/../config/notifier.php') => config_path('notifier.php'),
        ], 'config');

        $monolog = new Logger(config('notifier.name'));

        $logLevel = $monolog::toMonologLevel(config('notifier.level'));

        $handler = new DingtalkRobotHandler($logLevel);
        $handler->pushProcessor(new MemoryUsageProcessor());
        $handler->pushProcessor(new WebProcessor());

        $this->app['log']->pushHandler($handler);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
