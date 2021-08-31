<?php

namespace App\Providers;

use App\Models\Tag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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
        LengthAwarePaginator::useBootstrap();
        Paginator::useBootstrap();
        view()->composer('articles.includes.tags.tagsSideBar', function($view){
            return $view->with('tags', Tag::tagsCloud());
        });
    }
}
