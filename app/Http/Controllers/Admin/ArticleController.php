<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Services\TagsSynchronizer;

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
            ->withoutGlobalScopes()
            ->simplePaginate(20);
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Article $article
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * @param ArticleUpdateRequest $request
     * @param Article $article
     * Обновление статьи
     */
    public function update(ArticleUpdateRequest $request, TagsSynchronizer $tagsSynchronizer, Article $article)
    {
        $data = $request->all();
        $article->update($data);

        /**
         * @var $tagsFromRequest \Illuminate\Support\Collection
         */
        $tagsFromRequest =
            collect(explode(', ', request('tags')));

        $tagsSynchronizer->sync($tagsFromRequest, $article);

        return redirect()
            ->back()
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
            ->route('admin.articles.index')
            ->with(['success' => 'Успешно удалено']);
    }
}
