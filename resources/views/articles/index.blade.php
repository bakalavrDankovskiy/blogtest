@extends('layouts.app')

@section('content')

    @php /** @var $articles \App\Models\Article */@endphp
    <div class="container">
        @include('layouts.includes.result_messages')
        <div class="row">
            <div class="blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Статьи
                </h3>
                @foreach($articles as $article)
                    <div class="blog-post justify-content-center mb-5 border-bottom">
                        <a href="{{route('articles.show', $article->slug)}}"><h2
                                class="blog-post-title">{{$article->title}}</h2></a>
                        <p class="blog-post-meta">{{$article->created_at}}</p>
                        <p>{{$article->excerpt}}</p>
                        @if(!$article->is_published)
                            <p class="alert-info">Не опубликована</p>
                        @endif
                    </div><!-- /.blog-post -->
                @endforeach
            </div><!-- /.blog-main -->
        </div><!-- /.row -->
    </div>
@endsection
