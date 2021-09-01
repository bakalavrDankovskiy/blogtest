<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Вывод всех статей в порядке убывания даты создания
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleCreateRequest $request)
    {
        $data = $request->input();
        Article::create($data);
        return redirect()
            ->route('articles.create')
            ->with(['success' => 'Успешно сохранено']);
    }

    /**
     * Display the specified resource.
     * @param Article $article
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Article $article
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * @param ArticleUpdateRequest $request
     * @param Article $article
     * Обновление статьи
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $data = $request->all();
        $result = $article->update($data);
        return redirect()
            ->route('articles.edit', $article->slug)
            ->with(['success' => 'Успешно сохранено']);
    }

    /**
     * Remove the specified resource from storage.
     * @param Article $article
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()
            ->route('articles.index')
            ->with(['success' => 'Успешно удалено']);
    }
}
