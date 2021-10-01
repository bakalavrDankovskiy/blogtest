<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\NewsPost;
use App\Models\NewsPostComment;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;
use App\Policies\NewsPostCommentPolicy;
use App\Policies\NewsPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Comment::class => CommentPolicy::class,
        NewsPost::class => NewsPostPolicy::class,
        NewsPostComment::class => NewsPostCommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(\Illuminate\Contracts\Auth\Access\Gate $gate)
    {
        $this->registerPolicies();
    }
}
