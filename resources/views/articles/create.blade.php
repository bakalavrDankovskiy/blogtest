@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.includes.result_messages')
        <figure class="text-center">
            <blockquote class="blockquote">
                <p class="font-weight-bold">Напишите новую статью</p>
            </blockquote>
        </figure>
        <form action="{{route('articles.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input name="title" class="form-control" placeholder="Название статьи">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Символьный код статьи</label>
                <input name="slug" class="form-control" placeholder="Символьный код статьи">
            </div>
            <div class="mb-3">
                <label for="excerpt" class="form-label">Краткое описание</label>
                <textarea name="excerpt" class="form-control" id="excerpt" rows="3"
                          placeholder="Кратко опишите содержание"></textarea>
            </div>
            <div class="mb-3">
                <label for="txt" class="form-label">Текст статьи</label>
                <textarea name="txt" class="form-control" id="txt" rows="3"
                          placeholder="Введите текст статьи"></textarea>
            </div>
            <div class="form-check">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox"
                       name="is_published"
                       class="form-check-input"
                       value="1"
                       checked="checked">
                <label for="is_published" class="form-check-label">Опубликовано</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
