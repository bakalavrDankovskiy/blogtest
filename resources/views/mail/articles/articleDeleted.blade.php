@php
    /**
     * @var $article \App\Models\Article
    **/
@endphp
@component('mail::message')

    Статья {{$article->title}} была удалена
    @component('mail::button', ['url' => route('articles.index')])
        Ссылка на главную страницу
    @endcomponent

    Спасибо,
    {{ config('app.name') }}
@endcomponent
