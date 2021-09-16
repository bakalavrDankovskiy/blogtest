<?php

namespace App\Observers;

// Notifications
use App\Notifications\{
    ArticleCreatedNotification,
    ArticleDeletedNotification,
    ArticleUpdatedNotification,
};

// Models
use App\Services\Pushall;
use App\Models\{
    Article,
    User
};

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     *

     * @return void
     */

    private $pushall;

    public function __construct(Pushall $pushall)
    {
        dd($pushall);
        $this->pushall = $pushall;
    }

    public function created(Article $article)//, Pushall $pushall)
    {
        /**
         * Pushall уведомление
         */
        //$pushall->send('Была создана статья ' . $article->title, $article->excerpt);
        //dd($this->pushall);
        $this->pushall->send('Была создана статья ' . $article->title, $article->excerpt);
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
