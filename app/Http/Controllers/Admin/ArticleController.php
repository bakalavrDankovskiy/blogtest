<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Вывод всех статей в порядке убывания даты создания
     */
    public function index()
    {
        $articles = Article::with('tags')
            ->latest()
            ->withoutGlobalScopes()
            ->paginate(20);
        return view('articles.index', compact('articles'));
    }

    public function showHistory(Article $article)
    {
        $histories = $article->articleChanges;
        return view('admin.articles.articleHistory', compact(['article', 'histories']));
    }
}
