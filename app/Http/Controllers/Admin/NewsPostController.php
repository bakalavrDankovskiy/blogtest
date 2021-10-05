<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsPostCreateRequest;
use App\Http\Requests\NewsPostUpdateRequest;
use App\Models\NewsPost;
use App\Services\TagsSynchronizer;

class NewsPostController extends Controller
{
    public function index()
    {
        $newsPosts = NewsPost::latest()
            ->with('tags')
            ->paginate(20);
        return view('news.index', compact('newsPosts'));
    }

    /**
     * Display the specified resource.
     * @param \App\Models\NewsPost $newsPost
     */
    public function show(NewsPost $newsPost)
    {
        return view('news.show', compact('newsPost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsPostCreateRequest $request
     */
    public function store(NewsPostCreateRequest $request)
    {
        NewsPost::create($request->input());

        return redirect()
            ->route('admin.newsPosts.create')
            ->with(['success' => 'Успешно сохранено']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\NewsPost $newsPost
     */
    public function edit(NewsPost $newsPost)
    {
        return view('admin.news.edit', compact('newsPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsPostUpdateRequest $request, TagsSynchronizer $tagsSynchronizer, NewsPost $newsPost)
    {
        $data = $request->input();
        $newsPost->update($data);

        /**
         * @var $tagsFromRequest \Illuminate\Support\Collection
         */
        $tagsFromRequest =
            collect(explode(', ', request('tags')));

        $tagsSynchronizer->sync($tagsFromRequest, $newsPost);

        return redirect()
            ->back()
            ->with(['success' => 'Успешно сохранено']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\NewsPost $newsPost
     */
    public function destroy(NewsPost $newsPost)
    {
        $newsPost->delete();

        return redirect()
            ->route('admin.newsPosts.index')
            ->with(['success' => 'Успешно удалено']);
    }
}
