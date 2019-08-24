<?php

namespace Kolirt\Ukrposhta;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    protected $commands = [
        Commands\InstallCommand::class
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ukrposhta.php', 'ukrposhta');

        $this->publishes([
            __DIR__ . '/../config/ukrposhta.php' => config_path('ukrposhta.php')
        ]);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->commands($this->commands);

        app()->bind('ukrposhta', function () {
            return new Ukrposhta();
        });
    }
}