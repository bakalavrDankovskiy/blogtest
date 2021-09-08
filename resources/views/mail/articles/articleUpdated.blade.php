@php
    /**
     * @var $article \App\Models\Article
    **/
@endphp
@component('mail::message')

    Статья {{$article->title}} была обновлена
    @component('mail::button', ['url' => route('articles.show', $article)])
        Ссылка на статью
    @endcomponent

    Спасибо,
    {{ config('app.name') }}
@endcomponent
