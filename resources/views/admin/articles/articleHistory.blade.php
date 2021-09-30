@extends('layouts.app')

@section('content')
    <h2>Изменения статьи "{{$article->title}}"</h2>
    <h3>Автор {{$article->owner->name}}</h3>
    <div class="row">
        @foreach($histories as $history)
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5>{{$history->created_at}}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Пользователь {{$history->user->name}}</li>
                        <li class="list-group-item">Измененные
                            поля: {{implode(', ', json_decode($history->dirty_fields))}}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
