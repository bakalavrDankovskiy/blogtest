<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider
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
        /*
         * Blade-директивы для ролей
         */

        /*
         * @admin
         */
        \Blade::directive('admin', function () {
        return "<?php if(auth()->check() && auth()->user()->role->name == 'admin') : ?>";
        });
        \Blade::directive('endadmin', function () {
            return "<?php endif; ?>";
        });
    }
}
