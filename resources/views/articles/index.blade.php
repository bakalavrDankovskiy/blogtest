@extends('layouts.app')

@section('content')

    @php /** @var $articles \App\Models\Article */
        /** @var $tags \App\Models\Tag */
    @endphp

    <div class="container">
        @admin
        <div class="alert-success">
            ЭТО ДОЛЖЕН ВИДЕТЬ ТОЛЬКО АДМИН
        </div>
        @endadmin

        @include('layouts.includes.result_messages')
        <div class="row">
            <div class="blog-main col-8">
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
                            @if(!$article->is_published)
                                <p class="alert-info col-8">Не опубликована</p>
                            @endif
                            <blockquote class="font-italic font-weight-bold col-4">
                                Автор: {{$article->owner->name}}</blockquote>
                                @can('delete', $article)
                                    <form action="{{route('articles.delete', $article->slug)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                @endcan
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
        </div><!-- /.row -->
    </div>
@endsection
