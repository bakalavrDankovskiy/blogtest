<?php

namespace App\Observers;

// Mail
use App\Mail\{
    ArticleCreated,
    ArticleDeleted,
    ArticleUpdated,
};

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
        \Mail::to((User::admin())->email)->send(
            new ArticleCreated($article)
        );
    }

    /**
     * Handle the Article "updated" event.
     *
     * @param \App\Models\Article $article
     * @return void
     */
    public function updated(Article $article)
    {
        \Mail::to(User::admin()->email)->send(
            new ArticleUpdated($article)
        );
    }

    /**
     * Handle the Article "deleted" event.
     *
     * @param \App\Models\Article $article
     * @return void
     */
    public function deleted(Article $article)
    {
        \Mail::to(User::admin()->email)->send(
            new ArticleDeleted($article)
        );
    }
}
