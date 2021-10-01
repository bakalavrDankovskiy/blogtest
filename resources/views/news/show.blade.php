@extends('layouts.app')

@section('content')

    @php
        /** @var $newsPost \App\Models\NewsPost **/
        /** @var $newsPostcomments \Illuminate\Support\Collection*/
        $newsPostComments = $newsPost->comments ?? collect();
    @endphp
    <div class="container">
        <div class="row">
            <div class="blog-main col-8">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Новость "{{$newsPost->title}}"
                </h3>
                <div class="blog-post justify-content-center mb-5 border-bottom">
                    <label for="created_at">Дата написания</label>
                    <p class="blog-post-meta" id="created_at">{{$newsPost->created_at}}</p>

                    <p class="text-justify">{{$newsPost->txt}}</p>
                    @if(!$newsPost->is_published)
                        <p class="alert-info">Не опубликована</p>
                    @endif
                    @can('update', $newsPost)
                        <a href="{{route('admin.newsPosts.edit', $newsPost)}}">
                            <button class="btn btn-warning">Отредактировать</button>
                        </a>
                    @endcan
                    @can('delete', $newsPost)
                        <form action="{{route('admin.newsPosts.destroy', $newsPost)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    @endcan
                </div><!-- /.blog-post -->
            </div><!-- /.blog-main -->
        </div><!-- /.row -->
    </div> <!--/.container -->
@endsection
