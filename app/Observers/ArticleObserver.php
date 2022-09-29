<?php

namespace App\Observers;

use App\Events\ArticleUpdated;
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
    public function updating(Article $article)
    {
        $dirtyFields = array_keys($article->getDirty());
        $article->history()->attach(auth()->id(), [
            'dirty_fields' => json_encode($dirtyFields),
        ]);
    }

    public function updated(Article $article)
    {
        event(new ArticleUpdated(
            $article->id,
            array_keys($article->getDirty()),
            route('articles.show', $article)
        ));

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
