@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    @foreach($tags as $tag)
            <div class="p-2">
                <a class="btn btn-primary" href="{{route('articles.tag', $tag)}}">{{$tag->name}}</a>
            </div>
    @endforeach
@endif
