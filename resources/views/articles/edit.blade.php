@php
    /**
     * @var $article \App\Models\Article
     **/
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <figure class="text-center">
            <blockquote class="blockquote">
                <p class="font-weight-bold">Отредактировать статью '{{$article->title}}'</p>
            </blockquote>
        </figure>
        @admin
        <form action="{{route('articles.update', $article)}}" method="POST">
            @else
                <form action="{{route('articles.update', $article)}}" method="POST">
        @endadmin
                    @method('PATCH')
                    @include('articles.includes.articleForm')
                </form>
    </div>
@endsection
