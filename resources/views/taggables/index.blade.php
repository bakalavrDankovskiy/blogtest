@extends('layouts.app')

@php
    /** @var $taggables  array*/
    /** @var $tags \App\Models\Tag */

    extract($taggables, EXTR_OVERWRITE);
@endphp

@section('content')
    <div class="justify-content-center">
        <h2>Всё по тегу "<strong>{{$searchTag->name}}</strong>"</h2>
    </div>
    <div class="row">
        @if($articles->isNotEmpty())
            <div class="blog-main articles col-6">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Статьи
                </h3>
                @foreach($articles as $article)
                    <div class="blog-post justify-content-center mb-5 border-bottom">
                        <a href="{{route('articles.show', $article->slug)}}"><h2
                                class="blog-post-title">{{$article->title}}</h2></a>
                        <p class="blog-post-meta">{{$article->created_at}}</p>

                        <div class="row">
                            @include('articles.includes.tags.articleTags', ['tags' => $article->tags])
                        </div>

                        <p>{{$article->excerpt}}</p>

                        <div class="row justify-content-end">
                            <blockquote class="font-italic font-weight-bold col-4">
                                Автор: {{$article->owner->name}}</blockquote>
                            @admin
                            <a href="{{route('articles.edit', $article)}}">
                                <button class="btn btn-warning">Отредактировать</button>
                            </a>
                            <form action="{{route('articles.delete', $article->slug)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">Удалить</button>
                            </form>
                            @endadmin
                        </div>
                    </div><!-- /.blog-post -->
                @endforeach
            </div><!-- /.blog-main -->
        @endif

        @if($newsPosts->isNotEmpty())
            <div class="blog-main news-posts col-6">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Новости
                </h3>
                @foreach($newsPosts as $newsPost)
                    <div class="blog-post justify-content-center mb-5 border-bottom">
                        <a href="{{route('newsPosts.show', $newsPost)}}"><h2
                                class="blog-post-title">{{$newsPost->title}}</h2></a>
                        <p class="blog-post-meta">{{$newsPost->created_at}}</p>

                        <div class="row">
                            @include('articles.includes.tags.articleTags', ['tags' => $newsPost->tags])
                        </div>

                        <div class="row justify-content-end">
                            @admin
                            <a href="{{route('admin.newsPosts.edit', $newsPost)}}">
                                <button class="btn btn-warning">Отредактировать</button>
                            </a>
                            <form action="{{route('admin.newsPosts.destroy', $newsPost)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">Удалить</button>
                            </form>
                            @endadmin
                        </div>
                    </div><!-- /.blog-post news-posts -->
                @endforeach
            </div><!-- /.blog-main -->
        @endif
    </div><!-- /.row -->
@endsection
