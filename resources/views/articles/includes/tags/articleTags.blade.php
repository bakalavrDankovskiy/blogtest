@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    @foreach($tags as $tag)
        <li class="list-group-item">
         <span class="badge badge-pill badge-info">
            <a class="blockquote"
               style="text-decoration: none; color: #1d2124"
               href="{{route('articles.tag', $tag->getRouteKey())}}">{{$tag->name}}</a>
        </span>
        </li>
    @endforeach
@endif
