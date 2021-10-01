<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;

class NewsPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsPosts = NewsPost::latest()
            ->onlyPublished()
            ->simplePaginate(10);
        return view('news.index', compact('newsPosts'));
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\NewsPost  $newsPost
     */
    public function show(NewsPost $newsPost)
    {
        return view('news.show', compact('newsPost'));
    }
}
