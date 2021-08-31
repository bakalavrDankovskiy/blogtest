<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TagsSynchronizerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('tagsSynchronizer', 'App\Services\TagsSynchronizer');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

