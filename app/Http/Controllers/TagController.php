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
        $articles = $tag
            ->articles()
            ->with('tags')
            ->get();

        if (!(auth()->user()->isAdmin())) {
            $articles = $articles
                ->where('owner_id', '=', auth()->user()->id);
        }

        return view('articles.index', compact('articles'));
    }
}
