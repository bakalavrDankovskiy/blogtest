<?php

namespace App\Providers;

use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('articles.includes.tags.tagsSideBar', function ($view) {
            return $view->with('tags', Tag::tagsCloud());
        });

        Paginator::useBootstrap();
    }
}
