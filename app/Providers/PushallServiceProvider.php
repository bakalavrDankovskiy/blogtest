<?php

namespace App\Providers;

use App\Services\Pushall;
use Illuminate\Support\ServiceProvider;

class PushallServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('pushall', function (){
            return new Pushall(config('services.pushall.api.id'), config('services.pushall.api.key'));
        });
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
