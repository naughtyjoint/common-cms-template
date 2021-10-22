<?php

namespace Naughtyjoint\CMS;

use Illuminate\Support\ServiceProvider;

class CommonCmsTemplateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/cms.php' => config_path('cms.php'),
        ]);

        $this->publishes([
            __DIR__.'/../database/seeders/DatabaseSeeder.php' => database_path('seeders/DatabaseSeeder.php'),
        ]);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views'),
        ]);

        $this->publishes([
            __DIR__.'/../public' => public_path(),
        ]);

        $this->publishes([
            __DIR__.'/Models' => app_path('Models'),
        ]);

        $this->publishes([
            __DIR__.'/controllers' => app_path('Http/Controllers'),
        ]);

        $this->publishes([
            __DIR__.'/../routes/web.php' => base_path('routes/web.php'),
        ]);

        $this->publishes([
            __DIR__.'/Middleware/Authenticate.php' => app_path('Http/Middleware/Authenticate.php'),
        ]);

    }
}
