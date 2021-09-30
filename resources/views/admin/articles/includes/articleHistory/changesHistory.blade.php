@extends('layouts.app')
@php
    /**
     * @var $histories \Illuminate\Support\Collection
    **/
    $histories = $histories ?? collect();
@endphp
@section('content')
        <div class="row">
            @foreach($histories as $history)
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        От {{$history->created_at}}
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
