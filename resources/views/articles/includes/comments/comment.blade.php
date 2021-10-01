@php
    /**
     * @var \App\Models\Comment $comment
    **/
@endphp
<div class="card">
    <div class="card-header">
        {{$comment->user->name}} <strong>{{$comment->created_at}}</strong>
    </div>
    <div class="card-body">
        <p class="card-text">{{$comment->txt}}</p>
        @can('delete', $comment)
            <form action="{{route('comments.destroy', $comment)}}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Удалить</button>
            </form>
        @endcan
    </div>
</div>
