<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Tag $tag)
    {
        $articles = $tag->articles();
        $articles = auth()->user()->isNotAdmin() ? $articles->onlyOwned() : $articles->get();

        $newsPosts = $tag->newsPosts()->get();

        $taggables = [
            'searchTag' => $tag,
            'articles' => $articles,
            'newsPosts' => $newsPosts,
        ];

        return view('taggables.index', compact('taggables'));
    }

    public function articles(Tag $tag)
    {
        $articles = $tag
            ->articles()
            ->with('tags');

        $articles = auth()->user()->isNotAdmin() ? $articles->onlyOwned() : $articles->get();

        return view('articles.index', compact('articles'));
    }

    public function newsPosts(Tag $tag)
    {
        $newsPosts = $tag
            ->newsPosts()
            ->with('tags')
            ->get();

        return view('articles.index', compact('newsPosts'));
    }
}
