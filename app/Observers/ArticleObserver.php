<?php

namespace App\Observers;

use App\Notifications\{
    ArticleCreatedNotification,
    ArticleDeletedNotification,
    ArticleUpdatedNotification,
};
use App\Models\{
    Article,
    User
};
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
        /**
         * Pushall уведомление
         */
        Pushall::send("Юзер {$article->owner->name} обновил статью '{$article->title}'", $article->excerpt);

        /*
         * Уведомление админа по почте
         */
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
        Pushall::send("Юзер {$article->owner->name} создал статью '{$article->title}'", $article->excerpt);

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
        /**
         * Pushall уведомление
         */
        Pushall::send("Юзер {$article->owner->name} удалил статью '{$article->title}'", $article->excerpt);

        /*
         * Уведомление админа по почте
         */
        User::admin()
            ->notify(new ArticleDeletedNotification($article));
    }
}
