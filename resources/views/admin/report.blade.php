@extends('layouts.app')
@section('content')

    <h3>Cгенерить отчет в .csv и добавить в job</h3>
    <hr style="border: 0; border-top: 1px solid black">
    <form action="{{route('admin.report.generate')}}" method="POST">
        @csrf
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="items[articles]" id="flexCheckDefault" value="1">
            <label class="form-check-label" for="flexCheckDefault">
                Articles
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="items[news]" id="flexCheckDefault" value="1">
            <label class="form-check-label" for="flexCheckDefault">
                News
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="items[comments]" value="1" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                комментарии
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="items[tags]" value="1" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                теги
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="items[users]" value="1" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                количество пользователей
            </label>
        </div>

        <hr style="border: 0; border-top: 1px solid black">

        <h4><strong>Формат отчета</strong></h4>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="formats[xlsx]" value="xlsx" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                .xlsx
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="formats[csv]" value="csv" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                .csv
            </label>
        </div>

        <hr style="border: 0; border-top: 1px solid black">

        <button type="submit" class="btn-outline-success">Сгенерить отчет</button>
    </form>

@endsection

