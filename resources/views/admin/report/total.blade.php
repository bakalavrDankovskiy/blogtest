@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Создание итогового отчёта</h3>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="users">
            <label class="form-check-label" for="defaultCheck1">
                Пользователи
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="news">
            <label class="form-check-label" for="defaultCheck1">
                Новости
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="articles">
            <label class="form-check-label" for="defaultCheck1">
                Статьи
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="tags">
            <label class="form-check-label" for="defaultCheck1">
                Теги
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="comments">
            <label class="form-check-label" for="defaultCheck1">
                Комментарии
            </label>
        </div>

        <span title="Выбрать всё" onclick="eventCheckBox()" class="mt-md-2 badge badge-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                 height="16" fill="currentColor"
                 class="bi bi-card-checklist"
                 viewBox="0 0 16 16">
            <path
                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
            <path
                d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
            </svg>
        </span>

        <a class="mt-3 btn btn-primary" href="#" role="button">Отправить отчёт</a>
    </div>
@endsection

<script>
    function eventCheckBox() {
        let checkboxes = document.getElementsByTagName("input");
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = !checkboxes[i].checked;
        }
    }
</script>
