@php
    /**
     * @var $article \App\Models\Article
     **/
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.includes.result_messages')
        <figure class="text-center">
            <blockquote class="blockquote">
                <p class="font-weight-bold">Отредактировать статью '{{$article->title}}'</p>
            </blockquote>
        </figure>
        <form action="{{route('admin.articles.update', $article)}}" method="POST">
            @method('PATCH')
            @include('articles.includes.articleForm')
        </form>
    </div>
@endsection
