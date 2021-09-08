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
            ->where('owner_id', '=', auth()->user()->id)
            ->with('tags')
            ->get();
        return view('articles.index', compact('articles'));
    }
}
