@php
    /**
     * @var $newsPost \App\Models\NewsPost
     **/
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <figure class="text-center">
            <blockquote class="blockquote">
                <p class="font-weight-bold">Отредактировать новость '{{$newsPost->title}}'</p>
            </blockquote>
        </figure>
        <form action="{{route('admin.newsPosts.update', $newsPost)}}" method="POST">
            @method('PATCH')
            @include('admin.news.includes.newsPostForm')
        </form>
    </div>
@endsection
