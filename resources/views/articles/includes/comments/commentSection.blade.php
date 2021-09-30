<div class="comments-section">
    @if(collect($comments)->isNotEmpty())
        <div class="card-header m-3">
            Комментарии к статье
        </div>
    @endif
        <div class="create-new-comment">
            @include('articles.includes.comments.commentForm')
        </div>
    @foreach($comments as $comment)
            <br>
        <div class="comment-item">
            @include('articles.includes.comments.comment')
        </div>
    @endforeach
</div>
