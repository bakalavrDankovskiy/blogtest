@extends('layouts.app')

@section('content')
    <div class="container">
        <figure class="text-center">
            <blockquote class="blockquote">
                <p class="font-weight-bold">Напишите новую статью</p>
            </blockquote>
        </figure>
        <form action="{{route('articles.store')}}" method="POST">
            @include('articles.includes.articleForm')
        </form>
    </div>
@endsection
