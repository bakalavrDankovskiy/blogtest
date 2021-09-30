<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

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

        return back()
            ->with(['success' => 'Комментарий добавлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()
            ->with(['success' => 'Комментарий удален']);
    }
}
