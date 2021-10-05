@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Статистика сайта</h3>
        <div class="row justify-content-left">
            <div class=" mr-3 mb-3 col-md-4 col-4 card">
                <div class="card-header"><strong>Общее количество статей</strong></div>
                <div class="card-body">
                    {{$articlesCount}}
                </div>
            </div>
            <div class=" mr-3 mb-3 col-md-4 col-4 card">
                <div class="card-header"><strong>Общее количество новостей:</strong></div>
                <div class="card-body">
                    {{$newsPostsCount}}
                </div>
            </div>
            <div class=" mr-3 mb-3 col-md-4 col-4 card">
                <div class="card-header"><strong>User with most articles:</strong></div>
                <div class="card-body">
                    {{'name: ' . $userWithMostArticles->name}}
                    <br>
                    {{'id:' . $userWithMostArticles->id}}
                </div>
            </div>
            <div class=" mr-3 mb-3 col-md-4 col-4 card">
                <div class="card-header"><strong>Самая длинная статья :</strong></div>
                <div class="card-body">
                    <strong>title: </strong>{{$longestArticle->title}}
                    <br>
                    <strong>id:</strong> {{$longestArticle->id}}
                    <br>
                    <strong>slug:</strong> <a href="{{route('articles.show', $longestArticle)}}">{{$longestArticle->slug}}</a>
                </div>
            </div>
            <div class=" mr-3 mb-3 col-md-4 col-4 card">
                <div class="card-header"><strong>Самая короткая статья :</strong></div>
                <div class="card-body">
                    <strong>title: </strong>{{$shortestArticle->title}}
                    <br>
                    <strong>id:</strong> {{$shortestArticle->id}}
                    <br>
                    <strong>slug:</strong> <a href="{{route('articles.show', $shortestArticle)}}">{{$shortestArticle->slug}}</a>
                </div>
            </div>
            <div class=" mr-3 mb-3 col-md-4 col-4 card">
                <div class="card-header"><strong>Среднее количество статей у пользователей:</strong></div>
                <div class="card-body">
                    {{round($averageArticleCountUsersHave)}}
                </div>
            </div>
            <div class=" mr-3 mb-3 col-md-4 col-4 card">
                <div class="card-header"><strong>Самая непостоянная статья :</strong></div>
                <div class="card-body">
                    <strong>title: </strong>{{$mostUpdatedArticle->title}}
                    <br>
                    <strong>id:</strong> {{$mostUpdatedArticle->id}}
                    <br>
                    <strong>slug:</strong> <a href="{{route('articles.show', $mostUpdatedArticle)}}">{{$mostUpdatedArticle->slug}}</a>
                </div>
            </div>
            <div class=" mr-3 mb-3 col-md-4 col-4 card">
                <div class="card-header"><strong>Самая обсуждаемая статья :</strong></div>
                <div class="card-body">
                    <strong>title: </strong>{{$mostCommentedArticle->title}}
                    <br>
                    <strong>id:</strong> {{$mostCommentedArticle->id}}
                    <br>
                    <strong>slug:</strong> <a href="{{route('articles.show', $mostCommentedArticle)}}">{{$mostCommentedArticle->slug}}</a>
                    <strong>Количество комментариев:</strong> {{$mostCommentedArticle->comments_count}}
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
