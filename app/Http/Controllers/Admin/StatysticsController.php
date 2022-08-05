<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\NewsPost;

class StatysticsController extends Controller
{
    public function index()
    {
        $articlesCount = Article::count();
        $newsPostsCount = NewsPost::count();
        $userWithMostArticles = User::withMostArticles();
        $longestArticle = Article::longest();
        $shortestArticle = Article::shortest();
        $averageArticleCountUsersHave = User::averageCountOfArticlesUsersHave();
        $mostUpdatedArticle = Article::mostUpdated();
        $mostCommentedArticle = Article::mostCommented();

        return view('admin.statysticks', compact([
            'articlesCount',
            'newsPostsCount',
            'userWithMostArticles',
            'newsPostsCount',
            'longestArticle',
            'shortestArticle',
            'averageArticleCountUsersHave',
            'mostUpdatedArticle',
            'mostCommentedArticle',
        ]));
    }
}
