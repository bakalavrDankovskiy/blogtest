<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
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
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
