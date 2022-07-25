@extends('layouts.app')

@php
    /** @var $newsPosts \Illuminate\Pagination\Paginator*/
@endphp

@section('content')
    <div class="row">
        <div class="blog-main col-8">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Новости
                <a title="Создать новость" href="{{route('admin.newsPosts.create')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen"
                         viewBox="0 0 16 16">
                        <path
                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                    </svg>
                </a>
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

                    <p>{{$newsPost->excerpt}}</p>

                    <div class="row justify-content-end">
                        @admin
                        <div class="row">
                            <div class="col-7">
                                @can('update', $newsPost)
                                    <a href="{{route('admin.newsPosts.edit', $newsPost)}}">
                                        <button class="btn btn-warning">Отредактировать</button>
                                    </a>
                                @endcan
                            </div>
                            <div class="col-5">
                                @can('delete', $newsPost)
                                    <form action="{{route('admin.newsPosts.destroy', $newsPost)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        @endadmin
                        <br>
                        <br>
                        <br>
                    </div>
                </div><!-- /.blog-post -->
            @endforeach
            <div class="pagination col-4">
                {{$newsPosts->links()}}
            </div>
        </div><!-- /.blog-main -->
    </div><!-- /.row -->
@endsection
