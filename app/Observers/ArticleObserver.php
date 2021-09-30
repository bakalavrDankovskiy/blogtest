<?php

namespace App\Observers;

// Notifications
use App\Notifications\{
    ArticleCreatedNotification,
    ArticleDeletedNotification,
    ArticleUpdatedNotification,
};

// Models
use App\Models\{
    Article,
    User
};

//Facades
use App\Facades\Pushall;

class ArticleObserver
{
    /**
     * Handle the Article "updated" event.
     *
     * @param \App\Models\Article $article
     * @return void
     */
    public function updated(Article $article)
    {
        User::admin()
            ->notify(new ArticleUpdatedNotification($article));
    }

    /**
     * Handle the Article "created" event.
     *
     * @return void
     */

    public function created(Article $article)
    {
        /**
         * Pushall уведомление
         */
        Pushall::send('Была создана статья ' . $article->title, $article->excerpt);

        /*
         * Уведомление админа по почте
         */
        User::admin()
            ->notify(new ArticleCreatedNotification($article));
    }

    /**
     * Handle the Article "deleted" event.
     *
     * @param \App\Models\Article $article
     * @return void
     */
    public function deleted(Article $article)
    {
        User::admin()
            ->notify(new ArticleDeletedNotification($article));
    }
}
