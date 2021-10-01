@extends('layouts.app')

@section('content')
    <div class="container">
        <figure class="text-center">
            <blockquote class="blockquote">
                <p class="font-weight-bold">Напишите новую новость</p>
            </blockquote>
        </figure>
        <form action="{{route('admin.newsPosts.store')}}" method="POST">
            @include('admin.news.includes.newsPostForm')
        </form>
    </div>
@endsection
