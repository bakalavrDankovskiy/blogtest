@extends('layouts.app')

@php
    /** @var $newsPosts \Illuminate\Pagination\Paginator*/
@endphp

@section('content')
    <div class="row">
        <div class="blog-main col-8">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Новости
            </h3>
            @foreach($newsPosts as $newsPost)
                <div class="blog-post justify-content-center mb-5 border-bottom">
                    <a href="{{route('newsPosts.show', $newsPost)}}"><h2
                            class="blog-post-title">{{$newsPost->title}}</h2></a>
                    @admin
                    @if(!$newsPost->is_published)
                        <p class="alert-info">Не опубликована</p>
                    @endif
                    @endadmin
                    <p class="blog-post-meta">{{$newsPost->created_at}}</p>

                    <div class="row">
                        @include('articles.includes.tags.articleTags', ['tags' => $newsPost->tags])
                    </div>

                    <p>{{$newsPost->excerpt}}</p>

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
                </div><!-- /.blog-post -->
            @endforeach
        </div><!-- /.blog-main -->
        <div class="tag-cloud col-4">
            <label for="tag-cloud-card" class="font-weight-bold">Облако тегов</label>
            <div id="tag-cloud-card" class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    @include('articles.includes.tags.tagsSideBar')
                </ul>
            </div>
        </div><!-- /.tag-cloud -->
        <div class="pagination col-4">
            {{$newsPosts->links()}}
        </div>
    </div><!-- /.row -->
@endsection
