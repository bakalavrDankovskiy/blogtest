@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.includes.result_messages')
        <figure class="text-center">
            <blockquote class="blockquote">
                <p class="font-weight-bold">Напишите администрации ваше обращение</p>
            </blockquote>
        </figure>
        <form action="{{route('feedbackMessage.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleFormControlInput1"
                       placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea name="txt" class="form-control" id="exampleFormControlTextarea1" rows="3"
                          placeholder="Введите обращение"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
