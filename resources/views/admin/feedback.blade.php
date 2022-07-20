@extends('layouts.app')

@php /** @var $messages \App\Models\FeedbackMessage */@endphp

@section('content')
    <div class="container">
        <div class="row">
            @foreach($messages as $message)
                <div class="card m-2" style="max-width: 18rem;">
                    <div class="card-header">{{$message->created_at}}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$message->email}}</h5>
                        <p class="card-text">{{$message->txt}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
