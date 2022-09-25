<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendTotalReport;
use App\Models\Article;
use App\Models\User;
use App\Models\NewsPost;

class StatisticsController extends Controller
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

        return view('admin.statistics', compact([
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

    public function totalReport()
    {
        $tables = array_keys(array_filter(request()->input('tables', fn($v) => $v !== '0')));

        SendTotalReport::dispatch($tables);

        return redirect()
            ->back()
            ->with(['success' => 'Отчет успешно отправлен']);
    }
}
