@extends('layouts.app')

@section('content')

    @php /** @var $article \App\Models\Article */@endphp
    <div class="container">
        <div class="row">
            <div class="blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Статья "{{$article->title}}"
                </h3>
                <div class="blog-post justify-content-center mb-5 border-bottom">
                    <label for="created_at">Дата написания</label>
                    <p class="blog-post-meta" id="created_at">{{$article->created_at}}</p>
                    @if(!$article->is_published)
                        <p class="tab-content">{{$article->txt}}</p>
                    @endif
                    <p class="alert-info">Не опубликована</p>
                    <a href="{{route('articles.edit', $article->slug)}}">
                        <button class="btn btn-warning">Отредактировать</button>
                    </a>
                    <form action="{{route('articles.delete', $article->slug)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" type="submit">Удалить</button>
                    </form>
                </div><!-- /.blog-post -->
            </div><!-- /.blog-main -->
        </div><!-- /.row -->
    </div> <!--/.container -->
@endsection
