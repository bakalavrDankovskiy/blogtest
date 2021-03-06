<?php

namespace App\Http\Controllers;

use App\Models\FeedbackMessage;
use App\Http\Requests\FeedbackMessageCreateRequest;

class FeedBackMessageController extends Controller
{
    public function index()
    {
        $messages = FeedbackMessage::orderBy('created_at', 'DESC')
            ->get();
        return view('admin.feedback', compact('messages'));
    }

    public function create()
    {
        return view('createFeedback');
    }

    public function store(FeedbackMessageCreateRequest $request)
    {
        $data = $request->input();
        FeedbackMessage::create($data);

        return redirect()
            ->route('feedbackMessage.create')
            ->with(['success' => 'Успешно сохранено']);
    }
}
