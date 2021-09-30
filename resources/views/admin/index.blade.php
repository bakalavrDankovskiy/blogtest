@extends('layouts.app')

@section('content')
    <div class="row justify-content-left col-6">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{route('admin.feedback')}}">Список обращений</a></li>
                <li class="list-group-item"><a href="{{route('admin.articles.index')}}">Редакция статей</a></li>
            </ul>
    </div>
@endsection
