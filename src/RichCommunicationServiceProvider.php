<?php

namespace YourVendor\RichCommunication;

use Illuminate\Support\ServiceProvider;

class RichCommunicationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('richcommunication', function ($app) {
            return new Services\RichCommunicationAPIService();
        });
    }

    public function boot()
    {
        // Publish the config file
        $this->publishes([
            __DIR__ . '/../config/richcommunication.php' => config_path('richcommunication.php'),
        ], 'config');
    }
}
