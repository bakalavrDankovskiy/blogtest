@extends('layouts.app')

@php /** @var $messages \App\Models\FeedbackMessage */@endphp

@section('content')
    <div class="container">
        <div class="row ">
            @foreach($messages as $message)
                <div class="card text-white bg-secondary mr-3 mb-3 col-md-4 " style="max-width: 18rem;">
                    <div class="card-header">Обращение,<br> дата {{$message->created_at}}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$message->email}}</h5>
                        <p class="card-text">{{$message->txt}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
