@extends('layouts.app')

@section('content')

    @php /** @var $article \App\Models\Article */@endphp
    <div class="container">
        <div class="row">
            <div class="blog-main col-8">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Статья "{{$article->title}}"
                </h3>
                <div class="blog-post justify-content-center mb-5 border-bottom">
                    <label for="created_at">Дата написания</label>
                    <p class="blog-post-meta" id="created_at">{{$article->created_at}}</p>
                    <blockquote class="font-italic font-weight-bold">Автор: {{$article->owner->name}}</blockquote>

                    @if($article->tags->isNotEmpty())
                        <label for="tags" class="font-italic font-weight-bold">Теги</label>
                        <div class="row">
                            @include('articles.includes.tags.articleTags', ['tags' => $article->tags])
                        </div>
                    @endif

                    <label for="excerpt" class="font-italic font-weight-bold">Краткое описание</label>
                    <p class="text-justify">{{$article->excerpt}}</p>
                    <label for="txt" class="font-italic font-weight-bold">Текст статьи</label>
                    <p class="text-justify">{{$article->txt}}</p>
                    @if(!$article->is_published)
                        <p class="alert-info">Не опубликована</p>
                    @endif
                    @can('update', $article)
                    <a href="{{route('articles.edit', $article->slug)}}">
                        <button class="btn btn-warning">Отредактировать</button>
                    </a>
                    @endcan
                    @can('delete', $article)
                    <form action="{{route('articles.delete', $article->slug)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" type="submit">Удалить</button>
                    </form>
                    @endcan
                </div><!-- /.blog-post -->
            </div><!-- /.blog-main -->
            <div class="tag-cloud col-4">
                <label for="tag-cloud-card" class="font-weight-bold">Облако тегов</label>
                <div id="tag-cloud-card" class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        @include('articles.includes.tags.tagsSideBar')
                    </ul>
                </div>
            </div><!-- /.tag-cloud -->
        </div><!-- /.row -->
    </div> <!--/.container -->
@endsection
