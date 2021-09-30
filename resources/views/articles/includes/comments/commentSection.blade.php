<div class="comments-section m-3">
    <div class="create-new-comment">
        @include('articles.includes.comments.commentForm')
    </div>
    <div class="card-header m-3">
        Комментарии к статье
    </div>
    @foreach($comments as $comment)
        <div class="comment-item">
            @include('articles.includes.comments.comment')
        </div>
    @endforeach
</div>
