@extends('layouts.app')

@php /** @var $articles \App\Models\Article */
        /** @var $tags \App\Models\Tag */
@endphp

@section('content')
    <div class="row">
        <div class="blog-main col-8">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Мои статьи
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
                        <div class="row">
                            <div class="col-7">
                                @can('update', $article)
                                    <a href="{{route('articles.edit', $article->slug)}}">
                                        <button class="btn btn-warning">Отредактировать</button>
                                    </a>
                                @endcan
                            </div>
                            <div class="col-5">
                                @can('delete', $article)
                                    <form action="{{route('articles.delete', $article->slug)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        @endadmin
                    </div>
                </div><!-- /.blog-post -->
            @endforeach
            <div class="pagination col-4">
                {{$articles->links()}}
            </div>
        </div><!-- /.blog-main -->
        <div class="tag-cloud col-4">
            <label for="tag-cloud-card" class="font-weight-bold">Облако тегов</label>
            <div id="tag-cloud-card" style="width: 18rem;">
                <div class="d-grid gap-3">
                    @include('articles.includes.tags.tagsSideBar')
                </div>
            </div>
        </div><!-- /.tag-cloud -->
    </div><!-- /.row -->
@endsection
