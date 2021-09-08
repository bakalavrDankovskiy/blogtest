<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Mail\ArticleCreated;
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
        $this->middleware('auth');
        $this->middleware('can:update,article')->except(['index', 'create', 'store']);
    }

    /**
     * Вывод всех статей в порядке убывания даты создания
     */
    public function index()
    {
        $articles = auth()->user()->articles()->with('tags')->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleCreateRequest $request, TagsSynchronizer $tagsSynchronizer)
    {
        $data = $request->input();
        $article = new Article();
        $data['owner_id'] = auth()->id();
        $article = $article->create($data);
        \Mail::to($article->owner->email)
            ->send(new ArticleCreated($article));
        /**
         * @var $tagsFromRequest \Illuminate\Support\Collection
         */
        $tagsFromRequest =
            collect(explode(', ', request('tags')));

        $tagsSynchronizer->sync($tagsFromRequest, $article);

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
        $this->authorize('update', $article);
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
         * @var $tagsFromRequest \Illuminate\Support\Collection
         */
        $tagsFromRequest =
            collect(explode(', ', request('tags')));

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
