@php
    /**
     * @var $article \App\Models\Article
    **/
@endphp

@csrf

<div class="mb-3">
    <label for="title" class="form-label">Название</label>
    <input name="title" class="form-control" placeholder="Название статьи"
           value="{{@$article ? $article->title : ""}}">
</div>
<div class="mb-3">
    <label for="slug" class="form-label">Символьный код статьи</label>
    <input name="slug" class="form-control" placeholder="Символьный код статьи"
    value="{{@$article ? $article->slug : ""}}">
</div>
<div class="mb-3">
    <label for="excerpt" class="form-label">Краткое описание</label>
    <textarea name="excerpt" class="form-control" id="excerpt" rows="3"
              placeholder="Кратко опишите содержание">{{@$article ? $article->excerpt : ""}}</textarea>
</div>
<div class="mb-3">
    <label for="txt" class="form-label">Текст статьи</label>
    <textarea name="txt" class="form-control" id="txt" rows="3"
              placeholder="Введите текст статьи">{{@$article ? $article->txt : ""}}</textarea>
</div>
<div class="mb-3">
    <label for="Tags" class="form-label">Теги</label>
    <input
        type="text"
        name="tags"
        id="Tags"
        placeholder="Теги" value="{{old('tags', @$article ? @$article->tags->pluck('name')->implode(', ') : '')}}">
</div>
<div class="form-check">
    <input type="hidden" name="is_published" value="0">
    <input type="checkbox"
           name="is_published"
           class="form-check-input"
           value="{{@$article ? $article->is_published : 1}}"
           checked="checked">
    <label for="is_published" class="form-check-label">Опубликовано</label>
</div>
<br>
<button type="submit" class="btn btn-primary">Submit</button>
