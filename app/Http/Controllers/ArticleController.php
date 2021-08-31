<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Collection;
use App\Services\TagsSynchronizer;

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
        $tags = Tag::orderBy('created_at', 'DESC')->get();
        return view('articles.index', compact('articles', 'tags'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleCreateRequest $request, TagsSynchronizer $tagsSynchronizer)
    {
        $data = $request->input();
        $article = new Article();
        $result = $article->create($data);

        /**
         * @var $tagsFromRequest Collection
         */
        $tagsFromRequest = collect(
            explode(', ', request('tags')))
            ->keyBy(function ($item) {
                return $item;
            });

        $tagsSynchronizer->sync($tagsFromRequest, $result);
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
    public function update(ArticleUpdateRequest $request, TagsSynchronizer $tagsSynchronizer, Article $article)
    {
        $data = $request->all();
        $article->update($data);

        /**
         * @var $tagsFromRequest Collection
         */
        $tagsFromRequest = collect(
            explode(', ', request('tags')))
            ->keyBy(function ($item) {
                return $item;
            });

        $tagsSynchronizer->sync($tagsFromRequest, $article);

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
