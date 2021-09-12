<?php

namespace App\Observers;

// Notifications
use App\Notifications\ArticleCreatedNotification;
use App\Notifications\ArticleDeletedNotification;
use App\Notifications\ArticleUpdatedNotification;

// Models
use App\Models\{
    Article,
    User
};

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     *
     * @param \App\Models\Article $article
     * @return void
     */
    public function created(Article $article)
    {
        User::admin()
            ->notify(new ArticleCreatedNotification($article));
    }

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
