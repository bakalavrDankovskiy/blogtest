@extends('layouts.app')

@section('content')

    @php /** @var $article \App\Models\Article */@endphp
    <div class="container">
        <div class="row">
            <div class="blog-main col-8">
                <h3 class="pb-3 mb-4 font-italic">
                    "{{$article->title}}"
                    @admin
                    @if($article->articleChanges->isNotEmpty())
                        <a href="{{route('admin.articles.changes', $article)}}" title="Посмотреть изменения">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd"
                                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a>
                    @endif
                    @endadmin
                </h3>
                <div class="blog-post justify-content-center mb-5">
                    <label for="created_at">Дата написания</label>
                    <p class="blog-post-meta font-italic font-weight-bold" id="created_at">{{$article->created_at}}</p>
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
                    <div class="row float-left">
                        <div class="col">
                            @can('update', $article)
                                <a href="{{route('articles.edit', $article)}}">
                                    <button class="btn btn-warning">Отредактировать</button>
                                </a>
                            @endcan
                        </div>
                        <div class="col">
                            @can('delete', $article)
                                <form action="{{route('articles.delete', $article)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Удалить</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div><!-- /.blog-post -->
                <br>
                <div id="comments">
                    @include('articles.includes.comments.commentSection', ['comments' => $article->comments])
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
    </div> <!--/.container -->
@endsection
