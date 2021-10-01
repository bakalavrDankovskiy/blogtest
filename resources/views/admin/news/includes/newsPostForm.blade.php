@php
/**
* @var $newsPost \App\Models\NewsPost
**/
@endphp

@csrf

<div class="mb-3">
    <label for="title" class="form-label">Название</label>
    <input name="title" class="form-control" placeholder="Название новости"
           value="{{@$newsPost ? $newsPost->title : ""}}">
</div>
<div class="mb-3">
    <label for="excerpt" class="form-label">Краткое описание</label>
    <textarea name="excerpt" class="form-control" id="excerpt" rows="3"
              placeholder="Кратко опишите содержание">{{@$newsPost ? $newsPost->excerpt : ""}}</textarea>
</div>
<div class="mb-3">
    <label for="txt" class="form-label">Текст новости</label>
    <textarea name="txt" class="form-control" id="txt" rows="3"
              placeholder="Введите текст новости">{{@$newsPost ? $newsPost->txt : ""}}</textarea>
</div>
<div class="form-check">
    <input type="hidden" name="is_published" value="0">
    <input type="checkbox"
           name="is_published"
           class="form-check-input"
           value="{{@$newsPost ? $newsPost->is_published : 1}}"
           checked="checked">
    <label for="is_published" class="form-check-label">Опубликовано</label>
</div>
<br>
<button type="submit" class="btn btn-primary">Submit</button>
