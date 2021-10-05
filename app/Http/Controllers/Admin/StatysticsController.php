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
        $userWithMostArticles = User::withCount('articles')->orderByDesc('articles_count')->get('name','id')->first();
        $longestArticle = Article::where('txt', \DB::table('articles')->max('txt'))->first();
        $shortestArticle = Article::where('txt', \DB::table('articles')->min('txt'))->first();
        $averageArticleCountUsersHave = User::active()->withCount('articles')->get()->avg('articles_count');
        $mostUpdatedArticle = Article::withCount('history')->orderByDesc('history_count')->first();
        $mostCommentedArticle = Article::withCount('comments')->orderByDesc('comments_count')->first();

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
