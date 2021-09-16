<?php

namespace App\Providers;

use App\Models\Article;
use App\Observers\ArticleObserver;
use App\Services\Pushall;
use Illuminate\Support\ServiceProvider;

class ArticleModelServiceProvider extends ServiceProvider
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
         * ArticleObserver
         */
        Article::observe(function (Pushall $pushall){
            return new ArticleObserver($pushall);
        });
    }
}
