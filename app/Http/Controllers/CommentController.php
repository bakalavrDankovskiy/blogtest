<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     */
    public function store(CommentRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        Comment::create($data);

        return Redirect::to(URL::previous() . "#comments");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return Redirect::to(URL::previous() . "#comments");
    }
}
